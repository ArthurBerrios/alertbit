<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Notificação</title>
</head>
<body style="margin: 0; padding: 0; background-color: #0f172a; font-family: sans-serif; color: #ffffff;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" style="padding: 50px 20px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 500px; background-color: #1e293b; border-radius: 20px; border: 1px solid #334155;">
                    <tr>
                        <td style="padding: 40px; text-align: center;">
                            <div style="font-size: 40px; margin-bottom: 20px;">🔔</div>
                            
                            <h2 style="margin: 0 0 15px 0; color: #f59e0b; font-size: 22px;">Atenção</h2>
                            
                            <p style="margin: 0; color: #cbd5e1; font-size: 16px; line-height: 1.6;">
                                {{ $text }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px; background-color: #0f172a; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; text-align: center;">
                            <a href="{{ config('app.url') }}" style="color: #94a3b8; font-size: 12px; text-decoration: none;">
                                Voltar para {{ config('app.name') }}
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>