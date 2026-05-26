@extends('layouts.adminlte')
@section('page_title', 'Conversación')
@section('extra_css')
<style>
    :root { --naranja: #FF6600; --azul: #007FFF; }
    .welcome-banner { background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); border-radius:12px; border-left:5px solid var(--naranja); color:white; padding:20px 25px; margin-bottom:25px; }
    .chat-container { background:white; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.08); overflow:hidden; }
    .chat-messages { height:450px; overflow-y:auto; padding:20px; background:#f8f9fa; }
    .msg { margin-bottom:16px; display:flex; flex-direction:column; }
    .msg.cliente { align-items:flex-start; }
    .msg.admin { align-items:flex-end; }
    .msg.bot { align-items:flex-start; }
    .msg-bubble { max-width:70%; padding:10px 15px; border-radius:12px; font-size:0.88rem; line-height:1.5; }
    .msg.cliente .msg-bubble { background:white; border:1px solid #e0e0e0; color:#333; border-radius:0 12px 12px 12px; }
    .msg.bot .msg-bubble { background:#f0f4ff; border:1px solid #d0d8ff; color:#333; border-radius:0 12px 12px 12px; }
    .msg.admin .msg-bubble { background:linear-gradient(135deg,#FF6600,#e65c00); color:white; border-radius:12px 0 12px 12px; }
    .msg-meta { font-size:0.72rem; color:#aaa; margin-top:4px; }
    .chat-input { padding:15px 20px; border-top:1px solid #e0e0e0; background:white; }
    .btn-enviar { background:var(--naranja); color:white; border:none; border-radius:20px; padding:8px 20px; font-weight:600; transition:all 0.3s; }
    .btn-enviar:hover { background:#e65c00; color:white; }
</style>
@stop
@section('page_content')
<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1">
                <i class="fas fa-comments me-2" style="color:#FF6600;"></i>
                Conversación con {{ $cliente?->nombre ?? $clienteUser->nombre }}
            </h5>
            <p class="mb-0" style="opacity:0.75; font-size:0.9rem;">{{ $clienteUser->email }}</p>
        </div>
        <a href="{{ route('admin.chat.index') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>
</div>

<div class="chat-container">
    <div class="chat-messages" id="chat-messages">
        @foreach($mensajes as $msg)
            <div class="msg {{ $msg->es_admin ? 'admin' : ($msg->es_bot ? 'bot' : 'cliente') }}">
                <div class="msg-bubble">{{ $msg->contenido }}</div>
                <div class="msg-meta">
                    {{ $msg->es_admin ? 'Taller' : ($msg->es_bot ? 'Asistente' : ($cliente?->nombre ?? $clienteUser->nombre)) }}
                    — {{ $msg->created_at->format('d/m/Y H:i') }}
                </div>
            </div>
        @endforeach
    </div>
    <div class="chat-input">
        <form method="POST" action="{{ route('admin.chat.responder', $clienteUser->id) }}">
            @csrf
            <div class="d-flex gap-2">
                <input type="text" name="mensaje" class="form-control rounded-pill"
                    placeholder="Escribe tu respuesta..." required autocomplete="off">
                <button type="submit" class="btn btn-enviar">
                    <i class="fas fa-paper-plane me-1"></i>Enviar
                </button>
            </div>
        </form>
    </div>
</div>
@stop

@section('extra_js')
<script>
    // Scroll al final del chat
    const chat = document.getElementById('chat-messages');
    chat.scrollTop = chat.scrollHeight;
</script>
@stop
