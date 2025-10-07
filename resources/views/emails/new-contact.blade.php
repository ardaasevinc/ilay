<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yeni İletişim Mesajı</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }

        .info-row {
            margin: 15px 0;
            padding: 15px;
            background: white;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }

        .label {
            font-weight: bold;
            color: #007bff;
        }

        .value {
            margin-top: 5px;
        }

        .message-box {
            background: white;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }

        .contact-highlight {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>💬 Yeni İletişim Mesajı</h1>
    </div>

    <div class="content">
        <p>Merhaba,</p>
        <p>Web sitesinden yeni bir iletişim mesajı alındı:</p>

        <div class="contact-highlight">
            <strong>{{ $contact->name }}</strong><br>
            <span style="color: #007bff;">{{ $contact->subject }}</span>
        </div>

        <div class="info-row">
            <div class="label">Ad Soyad:</div>
            <div class="value">{{ $contact->name }}</div>
        </div>

        <div class="info-row">
            <div class="label">E-posta:</div>
            <div class="value">{{ $contact->email }}</div>
        </div>

        <div class="info-row">
            <div class="label">Telefon:</div>
            <div class="value">{{ $contact->phone }}</div>
        </div>

        <div class="info-row">
            <div class="label">Konu:</div>
            <div class="value">{{ $contact->subject }}</div>
        </div>

        <div class="message-box">
            <div class="label">Mesaj:</div>
            <div class="value" style="margin-top: 10px; line-height: 1.8;">
                {{ $contact->message }}
            </div>
        </div>

        <div class="info-row">
            <div class="label">Gönderim Tarihi:</div>
            <div class="value">{{ $contact->created_at->format('d.m.Y H:i') }}</div>
        </div>

        <div class="info-row">
            <div class="label">IP Adresi:</div>
            <div class="value">{{ $contact->ip_address ?? 'Bilinmiyor' }}</div>
        </div>

        @if ($contact->user_agent)
            <div class="info-row">
                <div class="label">Tarayıcı Bilgisi:</div>
                <div class="value" style="font-size: 12px; color: #666;">{{ Str::limit($contact->user_agent, 120) }}
                </div>
            </div>
        @endif

        <div
            style="margin-top: 30px; padding: 15px; background: #fff3cd; border-radius: 5px; border: 1px solid #ffeaa7;">
            <strong>⚡ Önemli:</strong> Bu mesaja 24 saat içinde yanıt vermeyi unutmayın!
        </div>

        <div style="margin-top: 15px; padding: 15px; background: #e8f5e8; border-radius: 5px;">
            <strong>📞 Hızlı İletişim:</strong><br>
            <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a><br>
            <a href="tel:{{ str_replace([' ', '(', ')', '-'], '', $contact->phone) }}">{{ $contact->phone }}</a>
        </div>
    </div>

    <div class="footer">
        <p>Bu e-posta İlay Ajans CMS sistemi tarafından otomatik olarak gönderilmiştir.</p>
        <p>{{ now()->format('d.m.Y H:i') }}</p>
    </div>
</body>

</html>
