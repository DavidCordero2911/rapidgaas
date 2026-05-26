<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MensajeChat;
use App\Models\User;
use App\Models\Cliente;

class ChatController extends Controller
{
    public function mensaje(Request $request)
    {
        $user    = auth()->user();
        $cliente = Cliente::where('user_id', $user->id)->first();

        // Guardar mensaje del cliente
        MensajeChat::create([
            'emisor_id'   => $user->id,
            'receptor_id' => null,
            'cliente_id'  => $cliente?->id,
            'contenido'   => $request->mensaje,
            'es_bot'      => false,
            'es_admin'    => false,
        ]);

        // Obtener historial para contexto
        $historial = MensajeChat::where('emisor_id', $user->id)
            ->orderBy('created_at')
            ->get()
            ->map(fn($m) => [
                'role'    => $m->es_bot || $m->es_admin ? 'model' : 'user',
                'parts'   => [['text' => $m->contenido]],
            ])->values()->toArray();

        // Llamar a la IA
        $respuesta = $this->llamarIA($historial, $cliente);

        // Guardar respuesta del bot
        MensajeChat::create([
            'emisor_id'   => $user->id,
            'receptor_id' => null,
            'cliente_id'  => $cliente?->id,
            'contenido'   => $respuesta,
            'es_bot'      => true,
            'es_admin'    => false,
        ]);

        // Si el bot detecta que hay que derivar al admin
        $derivar = str_contains(strtolower($respuesta), 'nuestro equipo') ||
            str_contains(strtolower($respuesta), 'te contactaremos') ||
            str_contains(strtolower($respuesta), 'hemos registrado');

        if ($derivar) {
            // Notificar al admin
            $admins = User::role('admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new \App\Notifications\NuevoMensajeChat($user, $cliente));
            }
        }

        return response()->json(['respuesta' => $respuesta]);
    }

    public function historial()
    {
        $user     = auth()->user();
        $cliente  = Cliente::where('user_id', $user->id)->first();

        $mensajes = MensajeChat::where(function ($q) use ($user) {
            $q->where('emisor_id', $user->id)
                ->orWhere('receptor_id', $user->id);
        })
            ->orWhere('cliente_id', $cliente?->id)
            ->orderBy('created_at')
            ->get();

        return response()->json($mensajes);
    }

    public function adminIndex()
    {
        $conversaciones = MensajeChat::with(['user', 'cliente'])
            ->select('emisor_id')
            ->distinct()
            ->where('es_admin', false)
            ->get()
            ->map(function ($m) {
                $ultimo = MensajeChat::where('emisor_id', $m->emisor_id)
                    ->latest()
                    ->first();
                $noLeidos = MensajeChat::where('emisor_id', $m->emisor_id)
                    ->where('es_admin', false)
                    ->where('leido_admin', false)
                    ->count();
                return [
                    'user'      => User::find($m->emisor_id),
                    'cliente'   => $ultimo->cliente,
                    'ultimo'    => $ultimo,
                    'noLeidos'  => $noLeidos,
                ];
            });

        return view('admin.chat.index', compact('conversaciones'));
    }

    public function responder(Request $request, $userId)
    {
        $user    = auth()->user();
        $cliente = Cliente::where('user_id', $userId)->first();

        MensajeChat::create([
            'emisor_id'  => auth()->id(),
            'receptor_id' => $userId,
            'cliente_id' => $cliente?->id,
            'contenido'  => $request->mensaje,
            'es_bot'     => false,
            'es_admin'   => true,
        ]);

        // Marcar como leídos
        MensajeChat::where('emisor_id', $userId)
            ->where('leido_admin', false)
            ->update(['leido_admin' => true]);

        return redirect()->back()->with('success', 'Mensaje enviado.');
    }

    private function llamarIA(array $historial, $cliente): string
    {
        $apiKey = env('GROQ_API_KEY');

        $sistemaPrompt = "Eres el asistente virtual de RapidGaas, un taller de motos profesional en El Puerto de Santa María, Cádiz.
Tu objetivo es ayudar al cliente a describir su problema con su moto de forma clara y estructurada.
Habla siempre en español, con tono profesional pero cercano.
Sigue este flujo de conversación:
1. Saluda al cliente y pregunta qué problema tiene con su moto.
2. Pregunta la matrícula si no la ha mencionado.
3. Pregunta si el problema es urgente o puede esperar.
4. Una vez tengas toda la información, confirma que has registrado su consulta y dile que nuestro equipo se pondrá en contacto con él pronto. Incluye la frase 'hemos registrado tu consulta' en tu respuesta final.
Sé conciso, no hagas más de una pregunta a la vez.";

        if ($cliente) {
            $sistemaPrompt .= "\nEl cliente se llama {$cliente->nombre}.";
        }

        // Convertir historial al formato OpenAI/Groq
        $mensajes = [['role' => 'system', 'content' => $sistemaPrompt]];
        foreach ($historial as $msg) {
            $mensajes[] = [
                'role'    => $msg['role'] === 'model' ? 'assistant' : 'user',
                'content' => $msg['parts'][0]['text'],
            ];
        }

        $payload = [
            'model'    => 'llama-3.3-70b-versatile',
            'messages' => $mensajes,
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => 'https://api.groq.com/openai/v1/chat/completions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey,
            ],
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($ch);
        $error    = curl_error($ch);
        curl_close($ch);

        if ($error) {
            \Log::error('Groq curl error: ' . $error);
            return 'Error de conexión: ' . $error;
        }

        $data = json_decode($response, true);

        if (isset($data['error'])) {
            \Log::error('Groq API error: ' . json_encode($data['error']));
            return 'Error API: ' . $data['error']['message'];
        }

        return $data['choices'][0]['message']['content']
            ?? 'Error desconocido: ' . $response;
    }

    public function adminShow($userId)
    {
        $clienteUser = User::findOrFail($userId);
        $cliente     = Cliente::where('user_id', $userId)->first();

        $mensajes = MensajeChat::where(function ($q) use ($userId, $cliente) {
            $q->where('emisor_id', $userId)
                ->orWhere('receptor_id', $userId)
                ->orWhere('cliente_id', $cliente?->id);
        })
            ->orderBy('created_at')
            ->get();

        MensajeChat::where('emisor_id', $userId)
            ->where('es_admin', false)
            ->where('leido_admin', false)
            ->update(['leido_admin' => true]);

        return view('admin.chat.show', compact('clienteUser', 'cliente', 'mensajes'));
    }
}
