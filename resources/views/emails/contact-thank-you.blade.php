<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mesajınız Alındı</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: #f8f9fa;
            border-left: 4px solid #667eea;
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
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }

        .icon {
            font-size: 48px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <div class="icon">✉️</div>
            <h1>Teşekkürler!</h1>
            <p>Mesajınız başarıyla alındı</p>
        </div>

        <div class="content">
            <p>Merhaba <strong>{{ $contact->name }}</strong>,</p>

            <p>İletişim formu aracılığıyla gönderdiğiniz mesaj başarıyla tarafımıza ulaştı. Bizimle iletişime geçtiğiniz
                için teşekkür ederiz.</p>

            <div class="message-box">
                <h3>📋 Mesaj Detaylarınız</h3>
                <p><strong>Adınız:</strong> {{ $contact->name }}</p>
                <p><strong>E-posta:</strong> {{ $contact->email }}</p>
                @if ($contact->phone)
                    <p><strong>Telefon:</strong> {{ $contact->phone }}</p>
                @endif
                @if ($contact->subject)
                    <p><strong>Konu:</strong> {{ $contact->subject }}</p>
                @endif
                <p><strong>Tarih:</strong>
                    {{ $contact->created_at ? $contact->created_at->format('d.m.Y H:i') : date('d.m.Y H:i') }}</p>
            </div>

            <div class="contact-info">
                <h3>📞 İletişim Bilgilerimiz</h3>
                <p><strong>E-posta:</strong> info@kurumsalajans.com</p>
                <p><strong>Telefon:</strong> +90 212 000 00 00</p>
                <p><strong>Adres:</strong> İstanbul, Türkiye</p>
            </div>

            <p>Ekibimiz en kısa sürede mesajınızı değerlendirip size dönüş yapacaktır. Genellikle 24 saat içerisinde
                yanıt vermeye çalışıyoruz.</p>

            <p>Acil durumlar için doğrudan telefon numaramızdan bize ulaşabilirsiniz.</p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ config('app.url') }}" class="btn">Web Sitemizi Ziyaret Edin</a>
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
