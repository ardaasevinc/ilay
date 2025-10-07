<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yeni Marka Analizi Talebi</title>
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
            background: #ff6b35;
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
            padding: 10px;
            background: white;
            border-radius: 5px;
            border-left: 4px solid #ff6b35;
        }

        .label {
            font-weight: bold;
            color: #ff6b35;
        }

        .value {
            margin-top: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>🎯 Yeni Marka Analizi Talebi</h1>
    </div>

    <div class="content">
        <p>Merhaba,</p>
        <p>Yeni bir marka analizi talebi alındı. Detaylar aşağıdadır:</p>

        <div class="info-row">
            <div class="label">Şirket Adı:</div>
            <div class="value">{{ $brandBrief->company_name }}</div>
        </div>

        <div class="info-row">
            <div class="label">İletişim Kişisi:</div>
            <div class="value">{{ $brandBrief->contact_person }}</div>
        </div>

        <div class="info-row">
            <div class="label">E-posta:</div>
            <div class="value">{{ $brandBrief->email }}</div>
        </div>

        <div class="info-row">
            <div class="label">Telefon:</div>
            <div class="value">{{ $brandBrief->phone }}</div>
        </div>

        <div class="info-row">
            <div class="label">Sektör:</div>
            <div class="value">{{ $brandBrief->industry ?? 'Belirtilmedi' }}</div>
        </div>

        <div class="info-row">
            <div class="label">Şirket Büyüklüğü:</div>
            <div class="value">{{ $brandBrief->company_size ?? 'Belirtilmedi' }}</div>
        </div>

        <div class="info-row">
            <div class="label">Hedef Kitle:</div>
            <div class="value">{{ $brandBrief->target_audience ?? 'Belirtilmedi' }}</div>
        </div>

        <div class="info-row">
            <div class="label">Marka Konumlandırma:</div>
            <div class="value">{{ $brandBrief->brand_positioning ?? 'Belirtilmedi' }}</div>
        </div>

        <div class="info-row">
            <div class="label">Tercih Edilen İletişim:</div>
            <div class="value">
                @if ($brandBrief->preferred_contact == 'phone')
                    📞 Telefon
                @elseif($brandBrief->preferred_contact == 'whatsapp')
                    📱 WhatsApp
                @elseif($brandBrief->preferred_contact == 'email')
                    📧 E-posta
                @else
                    Belirtilmedi
                @endif
            </div>
        </div>

        <div class="info-row">
            <div class="label">Gönderim Tarihi:</div>
            <div class="value">{{ $brandBrief->created_at->format('d.m.Y H:i') }}</div>
        </div>

        <div class="info-row">
            <div class="label">IP Adresi:</div>
            <div class="value">{{ $brandBrief->ip_address ?? 'Bilinmiyor' }}</div>
        </div>

        <p style="margin-top: 30px; padding: 15px; background: #e8f5e8; border-radius: 5px;">
            <strong>💡 Not:</strong> Bu talebe en kısa sürede yanıt vermeyi unutmayın!
        </p>
    </div>

    <div class="footer">
        <p>Bu e-posta İlay Ajans CMS sistemi tarafından otomatik olarak gönderilmiştir.</p>
        <p>{{ now()->format('d.m.Y H:i') }}</p>
    </div>
</body>

</html>
