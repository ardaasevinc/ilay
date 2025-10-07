<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marka Brifiniz Alındı</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .email-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px;
        }

        .message-box {
            background: #fff5f5;
            border-left: 4px solid #f093fb;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .contact-info {
            background: #e9ecef;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .contact-info h3 {
            margin-top: 0;
            color: #495057;
        }

        .footer {
            background: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }

        .footer a {
            color: #74c0fc;
            text-decoration: none;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #f093fb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }

        .icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .brief-summary {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            border: 1px solid #dee2e6;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <div class="icon">🎨</div>
            <h1>Marka Brifiniz Alındı!</h1>
            <p>Yaratıcı sürecimizi başlattık</p>
        </div>

        <div class="content">
            <p>Merhaba <strong>{{ $brandBrief->company_name }}</strong> ekibi,</p>

            <p>Marka brief formunuzu başarıyla aldık. Detaylı bilgiler için teşekkür ederiz. Ekibimiz brief'inizi analiz
                etmeye başladı.</p>

            <div class="message-box">
                <h3>📊 Brief Özeti</h3>
                <p><strong>Şirket:</strong> {{ $brandBrief->company_name }}</p>
                <p><strong>İletişim:</strong> {{ $brandBrief->email }}</p>
                @if ($brandBrief->phone)
                    <p><strong>Telefon:</strong> {{ $brandBrief->phone }}</p>
                @endif
                @if ($brandBrief->website)
                    <p><strong>Website:</strong> {{ $brandBrief->website }}</p>
                @endif
                <p><strong>Tarih:</strong>
                    {{ $brandBrief->created_at ? $brandBrief->created_at->format('d.m.Y H:i') : date('d.m.Y H:i') }}</p>
            </div>

            @if ($brandBrief->project_type)
                <div class="brief-summary">
                    <h4>🎯 Proje Türü</h4>
                    <p>{{ $brandBrief->project_type }}</p>
                </div>
            @endif

            @if ($brandBrief->budget_range)
                <div class="brief-summary">
                    <h4>💰 Bütçe Aralığı</h4>
                    <p>{{ $brandBrief->budget_range }}</p>
                </div>
            @endif

            @if ($brandBrief->timeline)
                <div class="brief-summary">
                    <h4>⏰ Zaman Çizelgesi</h4>
                    <p>{{ $brandBrief->timeline }}</p>
                </div>
            @endif

            <div class="contact-info">
                <h3>🚀 Sıradaki Adımlar</h3>
                <p><strong>1.</strong> Brief analizi (1-2 iş günü)</p>
                <p><strong>2.</strong> Stratejik yaklaşım geliştirme</p>
                <p><strong>3.</strong> Detaylı sunum hazırlığı</p>
                <p><strong>4.</strong> Size özel çözüm önerimiz</p>
            </div>

            <p>Yaratıcı ekibimiz brief'inizi detaylı olarak inceleyecek ve size özel bir sunum hazırlayacak. Genellikle
                2-3 iş günü içerisinde detaylı geri dönüşümüzü yapıyoruz.</p>

            <p>Bu süreçte ek sorularımız olursa sizinle iletişime geçeceğiz.</p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ config('app.url') }}" class="btn">Portfolyomuzı İnceleyin</a>
            </div>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Kurumsal Ajans. Tüm hakları saklıdır.</p>
            <p>Bu e-posta otomatik olarak gönderilmiştir. Lütfen yanıtlamayın.</p>
            <p>Web: <a href="{{ config('app.url') }}">{{ config('app.url') }}</a></p>
        </div>
    </div>
</body>

</html>
