<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Abonelik Onayı</title>
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
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
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
            background: #f0fdff;
            border-left: 4px solid #4facfe;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .benefits-box {
            background: #e9ecef;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .benefits-box h3 {
            margin-top: 0;
            color: #495057;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }

        .benefit-icon {
            margin-right: 10px;
            font-size: 18px;
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
            background: #4facfe;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }

        .unsubscribe {
            margin-top: 20px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
            font-size: 12px;
            color: #6c757d;
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
            <div class="icon">📧</div>
            <h1>Hoş Geldiniz!</h1>
            <p>Bülten aboneliğiniz aktif edildi</p>
        </div>

        <div class="content">
            <p>Merhaba,</p>

            <p><strong>{{ $subscription->email }}</strong> e-posta adresiniz ile bülten listemize başarıyla kaydoldunuz.
                Sizi aramızda görmekten mutluluk duyuyoruz!</p>

            <div class="message-box">
                <h3>✅ Abonelik Detaylarınız</h3>
                <p><strong>E-posta:</strong> {{ $subscription->email }}</p>
                @if ($subscription->name)
                    <p><strong>Adınız:</strong> {{ $subscription->name }}</p>
                @endif
                <p><strong>Kayıt Tarihi:</strong>
                    {{ $subscription->created_at ? $subscription->created_at->format('d.m.Y H:i') : date('d.m.Y H:i') }}
                </p>
                <p><strong>Durum:</strong> <span style="color: #28a745; font-weight: bold;">Aktif</span></p>
            </div>

            <div class="benefits-box">
                <h3>📬 Neler Alacaksınız?</h3>

                <div class="benefit-item">
                    <span class="benefit-icon">🎯</span>
                    <span>Dijital pazarlama trendleri ve stratejileri</span>
                </div>

                <div class="benefit-item">
                    <span class="benefit-icon">💡</span>
                    <span>Yaratıcı proje örnekleri ve case study'ler</span>
                </div>

                <div class="benefit-item">
                    <span class="benefit-icon">🚀</span>
                    <span>Sektördeki yenilikler ve teknoloji güncellemeleri</span>
                </div>

                <div class="benefit-item">
                    <span class="benefit-icon">🎁</span>
                    <span>Özel fırsatlar ve abonelere özel içerikler</span>
                </div>

                <div class="benefit-item">
                    <span class="benefit-icon">📊</span>
                    <span>Ücretsiz rehberler ve e-kitaplar</span>
                </div>
            </div>

            <p>Haftalık olarak gönderdiğimiz bültende, dijital dünyadan son haberler, proje örnekleri ve işinizi
                büyütecek değerli içerikler yer alacak.</p>

            <p>İlk bülteniniz önümüzdeki hafta e-posta kutunuzda olacak. Spam klasörünüzü kontrol etmeyi unutmayın!</p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ config('app.url') }}" class="btn">Web Sitemizi Keşfedin</a>
            </div>

            <div class="unsubscribe">
                <p><strong>Abonelikten Çıkma:</strong></p>
                <p>E-posta almak istemezseniz, her bültenin alt kısmındaki "Abonelikten çık" linkini kullanabilir veya
                    bize doğrudan yanıt vererek aboneliğinizi iptal edebilirsiniz.</p>
            </div>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Kurumsal Ajans. Tüm hakları saklıdır.</p>
            <p>Bu e-posta otomatik olarak gönderilmiştir. Sorularınız için yanıtlayabilirsiniz.</p>
            <p>Web: <a href="{{ config('app.url') }}">{{ config('app.url') }}</a></p>
        </div>
    </div>
</body>

</html>
