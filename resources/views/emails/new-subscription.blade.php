<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yeni Abonelik</title>
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
            background: #28a745;
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
            border-left: 4px solid #28a745;
        }

        .label {
            font-weight: bold;
            color: #28a745;
        }

        .value {
            margin-top: 5px;
            font-size: 16px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }

        .email-highlight {
            background: #e8f5e8;
            padding: 10px;
            border-radius: 5px;
            font-size: 18px;
            text-align: center;
            color: #155724;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>📧 Yeni Abonelik</h1>
    </div>

    <div class="content">
        <p>Merhaba,</p>
        <p>Bülten listesine yeni bir abonelik kaydı yapıldı:</p>

        <div class="email-highlight">
            {{ $subscription->email }}
        </div>

        <div class="info-row">
            <div class="label">E-posta Adresi:</div>
            <div class="value">{{ $subscription->email }}</div>
        </div>

        <div class="info-row">
            <div class="label">Abonelik Durumu:</div>
            <div class="value">
                @if ($subscription->is_active)
                    ✅ Aktif
                @else
                    ❌ Pasif
                @endif
            </div>
        </div>

        <div class="info-row">
            <div class="label">Kayıt Tarihi:</div>
            <div class="value">{{ $subscription->created_at->format('d.m.Y H:i') }}</div>
        </div>

        <div class="info-row">
            <div class="label">IP Adresi:</div>
            <div class="value">{{ $subscription->ip_address ?? 'Bilinmiyor' }}</div>
        </div>

        @if ($subscription->user_agent)
            <div class="info-row">
                <div class="label">Tarayıcı Bilgisi:</div>
                <div class="value" style="font-size: 12px; color: #666;">
                    {{ Str::limit($subscription->user_agent, 100) }}</div>
            </div>
        @endif

        <p style="margin-top: 30px; padding: 15px; background: #e8f5e8; border-radius: 5px;">
            <strong>💡 İpucu:</strong> Yeni aboneye hoş geldin e-postası göndermeyi unutmayın!
        </p>
    </div>

    <div class="footer">
        <p>Bu e-posta İlay Ajans CMS sistemi tarafından otomatik olarak gönderilmiştir.</p>
        <p>{{ now()->format('d.m.Y H:i') }}</p>
    </div>
</body>

</html>
