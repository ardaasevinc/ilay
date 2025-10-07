<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Marka Analizleri Raporu</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h1 {
            color: #333;
            margin: 0;
        }

        .brand-brief {
            margin-bottom: 40px;
            page-break-inside: avoid;
            border: 1px solid #ddd;
            padding: 20px;
        }

        .brand-header {
            background-color: #f8f9fa;
            padding: 10px;
            margin: -20px -20px 20px -20px;
            border-bottom: 1px solid #ddd;
        }

        .brand-name {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .status {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }

        .status.pending {
            background: #ffc107;
            color: #856404;
        }

        .status.in_review {
            background: #17a2b8;
            color: white;
        }

        .status.completed {
            background: #28a745;
            color: white;
        }

        .section {
            margin-bottom: 15px;
        }

        .section-title {
            font-weight: bold;
            color: #666;
            border-bottom: 1px solid #eee;
            padding-bottom: 3px;
            margin-bottom: 8px;
        }

        .field {
            margin-bottom: 8px;
        }

        .field-label {
            font-weight: bold;
            color: #333;
        }

        .field-value {
            color: #666;
        }

        .row {
            display: flex;
        }

        .col {
            flex: 1;
            padding-right: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Marka Analizleri Raporu</h1>
        <p>Oluşturulma: {{ now()->format('d/m/Y H:i') }}</p>
        <p>Toplam Kayıt: {{ $brandBriefs->count() }}</p>
    </div>

    @foreach ($brandBriefs as $brief)
        <div class="brand-brief">
            <div class="brand-header">
                <h2 class="brand-name">{{ $brief->brand_name }}</h2>
                <span class="status {{ $brief->status }}">
                    {{ \App\Models\BrandBrief::getStatusOptions()[$brief->status] ?? $brief->status }}
                </span>
            </div>

            <div class="row">
                <div class="col">
                    <div class="section">
                        <div class="section-title">Temel Bilgiler</div>
                        <div class="field">
                            <span class="field-label">Sektör:</span>
                            <span class="field-value">{{ $brief->sector ?? 'Belirtilmemiş' }}</span>
                        </div>
                        <div class="field">
                            <span class="field-label">Faaliyet Yılı:</span>
                            <span class="field-value">{{ $brief->years_active ?? 'Belirtilmemiş' }}</span>
                        </div>
                        <div class="field">
                            <span class="field-label">Website:</span>
                            <span class="field-value">{{ $brief->website ?? 'Yok' }}</span>
                        </div>
                    </div>

                    <div class="section">
                        <div class="section-title">İletişim</div>
                        <div class="field">
                            <span class="field-label">İletişim Kişisi:</span>
                            <span class="field-value">{{ $brief->full_name }}</span>
                        </div>
                        <div class="field">
                            <span class="field-label">E-posta:</span>
                            <span class="field-value">{{ $brief->email }}</span>
                        </div>
                        <div class="field">
                            <span class="field-label">Telefon:</span>
                            <span class="field-value">{{ $brief->phone }}</span>
                        </div>
                    </div>
                </div>

                <div class="col">
                    @if ($brief->brand_summary)
                        <div class="section">
                            <div class="section-title">Marka Özeti</div>
                            <div class="field-value">{{ $brief->brand_summary }}</div>
                        </div>
                    @endif

                    @if ($brief->target_audience)
                        <div class="section">
                            <div class="section-title">Hedef Kitle</div>
                            <div class="field-value">{{ $brief->target_audience }}</div>
                        </div>
                    @endif

                    @if ($brief->three_words)
                        <div class="section">
                            <div class="section-title">Üç Kelime</div>
                            <div class="field-value">{{ $brief->three_words }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="section">
                <div class="section-title">Form Gönderim Bilgisi</div>
                <div class="field">
                    <span class="field-label">Gönderilme:</span>
                    <span class="field-value">{{ $brief->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
    @endforeach
</body>

</html>
