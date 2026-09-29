<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $asunto }}</title>
</head>
<body style="margin:0; padding:0; background-color:#0d0904; font-family:'Courier New', Courier, monospace; color:#ffd480;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color:#0d0904; padding:30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:620px; background-color:#140e06; border:2px solid #ffb642; border-collapse:collapse;">
                    
                    {{-- Encabezado Estilo RobCo / Mojave Express --}}
                    <tr>
                        <td style="background-color:#1c1308; padding:20px; border-bottom:2px solid #ffb642; text-align:left;">
                            <div style="font-size:10px; color:#a67c33; letter-spacing:2px; margin-bottom:4px;">
                                ROBCO INDUSTRIES UNIFIED OPERATING SYSTEM // MOJAVE DESPATCH
                            </div>
                            <h2 style="margin:0; font-size:18px; color:#ffb642; letter-spacing:1px; font-weight:bold;">
                                &gt; NOTIFICACIÓN DE INCIDENCIA [TICKET]
                            </h2>
                            <div style="font-size:11px; color:#ffd480; margin-top:4px;">
                                RELAY: BREVO SMTP &bull; PRIORIDAD: ALTA
                            </div>
                        </td>
                    </tr>

                    {{-- Ficha de Metadatos --}}
                    <tr>
                        <td style="padding:15px 20px; background-color:#0f0a04; border-bottom:1px dashed #996317; font-size:12px; color:#cfa25f;">
                            <table width="100%" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td width="28%" style="color:#ffb642; font-weight:bold;">REMITENTE:</td>
                                    <td>{{ $nombre }}</td>
                                </tr>
                                <tr>
                                    <td style="color:#ffb642; font-weight:bold;">ASUNTO:</td>
                                    <td>{{ $asunto }}</td>
                                </tr>
                                <tr>
                                    <td style="color:#ffb642; font-weight:bold;">ESTADO:</td>
                                    <td style="color:#34d399; font-weight:bold;">[ ENVIADO AL SERVIDOR ]</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Contenido del Mensaje --}}
                    <tr>
                        <td style="padding:25px 20px; color:#ffe8b3; font-size:14px; line-height:1.7;">
                            <p style="margin-top:0; color:#ffd480; font-weight:bold; font-size:12px;">
                                &gt; REGISTRO DE TRANSMISIÓN (LOG):
                            </p>
                            <div style="background-color:#080502; border:1px solid #331e04; padding:15px; color:#ffd480; font-size:13px; white-space:pre-line; border-left:3px solid #ffb642;">
{{ $mensaje }}
                            </div>
                            <p style="font-size:12px; color:#a67c33; margin-top:20px; margin-bottom:0;">
                                * Esta es una confirmación automática. No es necesario responder a este mensaje salvo instrucciones directas del operador central.
                            </p>
                        </td>
                    </tr>

                    {{-- Pie de Página RobCo --}}
                    <tr>
                        <td style="padding:15px 20px; text-align:center; background-color:#1c1308; border-top:2px solid #ffb642; color:#a67c33; font-size:10px; letter-spacing:1px;">
                            &gt; INDUSTRIAS CASANUEVA // SISTEMA DE TICKETS // ROBCO NV (C) {{ date('Y') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
