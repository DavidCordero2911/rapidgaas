<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de tu moto — RapidGaas</title>
</head>

<body
    style="margin:0; padding:0; background-color:#0f0f1a; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#0f0f1a; padding:30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%;">

                    {{-- HEADER --}}
                    <tr>
                        <td
                            style="background:linear-gradient(135deg,#1a1a2e,#0f3460); padding:35px 40px; text-align:center; border-bottom:4px solid #FF6600; border-radius:12px 12px 0 0;">
                            <div style="font-size:2rem; margin-bottom:8px;">🏍️</div>
                            <h1 style="margin:0; color:white; font-size:2rem; font-weight:800; letter-spacing:2px;">
                                RAPID<span style="color:#007FFF;">GAAS</span>
                            </h1>
                            <p
                                style="margin:8px 0 0 0; color:rgba(255,255,255,0.6); font-size:0.85rem; letter-spacing:1px; text-transform:uppercase;">
                                Actualización de tu vehículo
                            </p>
                        </td>
                    </tr>

                    {{-- BODY --}}
                    <tr>
                        <td style="background-color:#ffffff; padding:40px;">

                            <h2 style="margin:0 0 20px 0; color:#1a1a2e; font-size:1.4rem;">
                                ¡Tu moto ha sido actualizada! 🔧
                            </h2>

                            <p style="margin:0 0 20px 0; color:#444; font-size:1rem; line-height:1.6;">
                                Hola <strong>{{ $cliente->nombre }}</strong>, te informamos de que tu vehículo
                                <strong style="color:#FF6600;">{{ $orden->vehiculo->matricula }}</strong>
                                ({{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }}) ha cambiado de estado.
                            </p>

                            {{-- ESTADO ACTUAL --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:25px;">
                                <tr>
                                    <td
                                        style="background:#f8f9fa; border-radius:10px; padding:20px; text-align:center;">
                                        <p
                                            style="margin:0 0 8px 0; color:#666; font-size:0.85rem; text-transform:uppercase; letter-spacing:1px;">
                                            Estado actual</p>
                                        @php
                                            $colores = [
                                                'en_espera' => '#6c757d',
                                                'en_diagnostico' => '#007FFF',
                                                'en_reparacion' => '#FF6600',
                                                'finalizado' => '#28a745',
                                                'entregado' => '#1a1a2e',
                                            ];
                                            $color = $colores[$orden->estado] ?? '#6c757d';
                                        @endphp
                                        <span
                                            style="background-color:{{ $color }}; color:white; padding:10px 25px; border-radius:25px; font-weight:700; font-size:1rem; display:inline-block;">
                                            {{ ucfirst(str_replace('_', ' ', $orden->estado)) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            @if ($orden->actualizaciones->last()?->comentario)
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:25px;">
                                    <tr>
                                        <td
                                            style="background:#fff8f0; border-left:4px solid #FF6600; padding:15px 20px; border-radius:0 8px 8px 0;">
                                            <p
                                                style="margin:0 0 5px 0; color:#FF6600; font-weight:700; font-size:0.85rem;">
                                                Observación del mecánico:</p>
                                            <p style="margin:0; color:#444; font-size:0.9rem;">
                                                {{ $orden->actualizaciones->last()->comentario }}</p>
                                        </td>
                                    </tr>
                                </table>
                            @endif

                            @if ($orden->fecha_estimada)
                                <p style="margin:0 0 15px 0; color:#444; font-size:0.9rem;">
                                    📅 <strong>Entrega estimada:</strong>
                                    {{ \Carbon\Carbon::parse($orden->fecha_estimada)->format('d/m/Y') }}
                                </p>
                            @endif

                            @if ($orden->presupuesto_estimado)
                                <p style="margin:0 0 25px 0; color:#444; font-size:0.9rem;">
                                    💰 <strong>Presupuesto estimado:</strong>
                                    {{ number_format($orden->presupuesto_estimado, 2) }} €
                                </p>
                            @endif

                            {{-- BOTÓN --}}
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding:10px 0 20px 0;">
                                        <a href="{{ url('/login') }}"
                                            style="background-color:#FF6600; color:white; padding:15px 40px; text-decoration:none; border-radius:30px; font-weight:700; font-size:1rem; display:inline-block;">
                                            🏍️ Ver mi vehículo
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    {{-- FOOTER --}}
                    <tr>
                        <td
                            style="background:linear-gradient(135deg,#1a1a2e,#0f3460); padding:30px 40px; text-align:center; border-radius:0 0 12px 12px; border-top:4px solid #FF6600;">
                            <h3
                                style="margin:0 0 5px 0; color:white; font-size:1.2rem; font-weight:800; letter-spacing:2px;">
                                RAPID<span style="color:#007FFF;">GAAS</span>
                            </h3>
                            <p style="margin:0 0 8px 0; color:rgba(255,255,255,0.6); font-size:0.8rem;">Taller · Gestión
                                en Tiempo Real</p>
                            <p style="margin:0; color:rgba(255,255,255,0.4); font-size:0.75rem;">
                                © {{ date('Y') }} RapidGaas. Todos los derechos reservados.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
