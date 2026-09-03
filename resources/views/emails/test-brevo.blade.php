<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación UTN</title>
</head>

<body
    style="margin:0; padding:0; background-color:#f3f4f6; font-family:Arial, Helvetica, sans-serif;"
>

    <table
        role="presentation"
        style="width:100%; border-spacing:0; padding:40px 0;"
    >
        <tr>
            <td align="center">

                <table
                    role="presentation"
                    style="width:100%; max-width:600px; background:#ffffff; border-radius:8px; padding:30px; box-shadow:0 2px 8px rgba(0,0,0,0.1);"
                >
                    <tr>
                        <td
                            align="center"
                            style="padding-bottom:20px;"
                        >
                            <h2
                                style="margin:0; font-size:24px; color:#111827;"
                            >
                                📩 Notificación desde UTN
                            </h2>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="font-size:16px; color:#374151; line-height:1.6;"
                        >
                            <p>Hola,</p>

                            <p>
                                Este es un correo de prueba enviado desde
                                <strong>Laravel + Brevo SMTP</strong>
                                usando tu remitente Gmail.
                            </p>

                            <p style="margin-top:20px;">
                                ✅
                                <strong>
                                    El envío de email está funcionando correctamente.
                                </strong>
                            </p>

                            <p>
                                Ya podés usar este sistema para enviar
                                notificaciones, confirmaciones o alertas desde
                                tu aplicación.
                            </p>

                            @if(isset($mensaje) && !empty($mensaje) && $mensaje !== 'Hola 👋, esto es una prueba con Brevo SMTP en Laravel.')
                                <div style="margin-top:20px; padding:12px 16px; background-color:#f9fafb; border-left:4px solid #2563eb; border-radius:4px; font-size:15px; color:#1f2937;">
                                    {{ $mensaje }}
                                </div>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td
                            align="center"
                            style="padding-top:25px;"
                        >
                            <a
                                href="{{ config('app.url', '#') }}"
                                style="background-color:#2563eb; color:white; padding:12px 24px; text-decoration:none; border-radius:6px; font-size:15px; display:inline-block; font-weight:bold;"
                            >
                                Ir al sitio
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="padding-top:30px; font-size:13px; color:#6b7280; text-align:center;"
                        >
                            <p style="margin:0;">
                                &copy; {{ date('Y') }} UTN - Todos los derechos reservados.
                            </p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>

</html>
