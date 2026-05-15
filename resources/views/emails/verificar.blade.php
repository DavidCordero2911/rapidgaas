<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica tu email — RapidGaas</title>
</head>
<body style="margin:0; padding:0; background-color:#0f0f1a; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#0f0f1a; padding:30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%;">

                    {{-- HEADER --}}
                    <tr>
                        <td style="background:linear-gradient(135deg,#1a1a2e,#0f3460); padding:35px 40px; text-align:center; border-bottom:4px solid #FF6600; border-radius:12px 12px 0 0;">
                            <div style="font-size:2rem; margin-bottom:8px;">🏍️</div>
                            <h1 style="margin:0; color:white; font-size:2rem; font-weight:800; letter-spacing:2px;">
                                RAPID<span style="color:#007FFF;">GAAS</span>
                            </h1>
                            <p style="margin:8px 0 0 0; color:rgba(255,255,255,0.6); font-size:0.85rem; letter-spacing:1px; text-transform:uppercase;">
                                Taller con gestión de motos en tiempo real
                            </p>
                        </td>
                    </tr>

                    {{-- BODY --}}
                    <tr>
                        <td style="background-color:#ffffff; padding:40px;">

                            <h2 style="margin:0 0 20px 0; color:#1a1a2e; font-size:1.5rem;">
                                ¡Bienvenido a RapidGaas! 🔧
                            </h2>

                            <p style="margin:0 0 15px 0; color:#444; font-size:1rem; line-height:1.6;">
                                Gracias por unirte a <strong style="color:#FF6600;">RapidGaas</strong>.
                                Estás a un paso de poder consultar el estado de tu moto en tiempo real desde cualquier dispositivo.
                            </p>

                            <p style="margin:0 0 30px 0; color:#444; font-size:1rem; line-height:1.6;">
                                Por favor, verifica tu dirección de email para acceder a tu cuenta y empezar a disfrutar de nuestros servicios.
                            </p>

                            {{-- BOTÓN --}}
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding:10px 0 30px 0;">
                                        <a href="{{ $url }}"
                                           style="background-color:#FF6600; color:white; padding:15px 40px; text-decoration:none; border-radius:30px; font-weight:700; font-size:1rem; letter-spacing:1px; display:inline-block;">
                                            ✓ VERIFICAR MI EMAIL
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            {{-- ICONOS --}}
                            <p style="text-align:center; font-size:1.5rem; margin:0 0 20px 0;">
                                🔧 🏍️ 🏆
                            </p>

                            {{-- AVISO IMPORTANTE --}}
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#fff8f0; border-left:4px solid #FF6600; padding:15px 20px; border-radius:0 8px 8px 0;">
                                        <p style="margin:0; color:#444; font-size:0.9rem; line-height:1.5;">
                                            <strong style="color:#FF6600;">⏰ Importante:</strong>
                                            Este enlace de verificación expira en 60 minutos por motivos de seguridad.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    {{-- SECCIÓN PROBLEMAS CON EL BOTÓN --}}
                    <tr>
                        <td style="background-color:#f8f9fa; padding:25px 40px; border-top:1px solid #e9ecef;">
                            <p style="margin:0 0 10px 0; color:#1a1a2e; font-weight:700; font-size:0.9rem; text-transform:uppercase; letter-spacing:1px;">
                                ¿Problemas con el botón?
                            </p>
                            <p style="margin:0 0 10px 0; color:#666; font-size:0.85rem;">
                                Copia y pega este enlace en tu navegador:
                            </p>
                            <p style="margin:0; word-break:break-all;">
                                <a href="{{ $url }}" style="color:#007FFF; font-size:0.8rem; text-decoration:none;">
                                    {{ $url }}
                                </a>
                            </p>
                        </td>
                    </tr>

                    {{-- SEPARADOR --}}
                    <tr>
                        <td style="background-color:#f8f9fa; padding:0 40px;">
                            <hr style="border:none; border-top:1px solid #dee2e6; margin:0;">
                        </td>
                    </tr>

                    {{-- FOOTER --}}
                    <tr>
                        <td style="background:linear-gradient(135deg,#1a1a2e,#0f3460); padding:30px 40px; text-align:center; border-radius:0 0 12px 12px; border-top:4px solid #FF6600;">

                            <h3 style="margin:0 0 5px 0; color:white; font-size:1.2rem; font-weight:800; letter-spacing:2px;">
                                RAPID<span style="color:#007FFF;">GAAS</span>
                            </h3>
                            <p style="margin:0 0 20px 0; color:rgba(255,255,255,0.6); font-size:0.8rem;">
                                Taller · Gestión en Tiempo Real
                            </p>

                            <p style="margin:0 0 8px 0; color:rgba(255,255,255,0.7); font-size:0.85rem;">
                                📍 El Puerto de Santa María, Cádiz &nbsp;|&nbsp; 📞 +34 600 000 000
                            </p>
                            <p style="margin:0 0 20px 0; color:rgba(255,255,255,0.7); font-size:0.85rem;">
                                ✉️ info@rapidgaas.com &nbsp;|&nbsp; 🌐 www.rapidgaas.com
                            </p>

                            <p style="margin:0; color:rgba(255,255,255,0.4); font-size:0.75rem;">
                                © {{ date('Y') }} RapidGaas. Todos los derechos reservados.
                            </p>
                            <p style="margin:5px 0 0 0; color:rgba(255,255,255,0.3); font-size:0.7rem;">
                                Si no creaste una cuenta en RapidGaas, simplemente ignora este email.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
