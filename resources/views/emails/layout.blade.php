<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $subject ?? 'SIKI Polindra' }}</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f5f7; font-family: -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f5f7; padding:32px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="560" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,0.06);">
                    <tr>
                        <td style="background: {{ $headerColor ?? '#1f2937' }}; padding:24px 32px;">
                            <span style="color:#fff; font-size:16px; font-weight:700;">Sistem Informasi Kekayaan Intelektual</span><br>
                            <span style="color:rgba(255,255,255,.8); font-size:13px;">Politeknik Negeri Indramayu</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px;">
                            {{ $slot }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 32px; background:#fafafa; border-top:1px solid #eee;">
                            <span style="font-size:12px; color:#9ca3af;">
                                Email ini dikirim otomatis oleh sistem SIKI Polindra. Mohon tidak membalas email ini.
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
