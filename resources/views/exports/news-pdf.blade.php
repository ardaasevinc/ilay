<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Haberler Listesi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
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
            font-size: 24px;
        }

        .header p {
            color: #666;
            margin: 5px 0 0 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
        }

        .status-active {
            color: #059669;
            font-weight: bold;
        }

        .status-inactive {
            color: #dc2626;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }

        .category {
            background-color: #f3f4f6;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Haberler Listesi</h1>
        <p>Rapor Tarihi: {{ now()->format('d.m.Y H:i') }}</p>
        <p>Toplam Haber: {{ $news->count() }}</p>
    </div>

    @if ($news->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 3%">ID</th>
                    <th style="width: 5%">Görsel</th>
                    <th style="width: 18%">Haber Başlığı</th>
                    <th style="width: 12%">Slug</th>
                    <th style="width: 12%">Kategori</th>
                    <th style="width: 12%">SEO Başlık</th>
                    <th style="width: 8%">Durum</th>
                    <th style="width: 8%">Ana Sayfa</th>
                    <th style="width: 10%">Oluşturulma</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->img ? 'Var' : 'Yok' }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                            @if ($item->news_category)
                                <span class="category">{{ $item->news_category->title }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $item->seo_title ?? '-' }}</td>
                        <td>
                            <span class="status-{{ $item->is_active ? 'active' : 'inactive' }}">
                                {{ $item->is_active ? 'Aktif' : 'Pasif' }}
                            </span>
                        </td>
                        <td>
                            <span class="status-{{ $item->is_home ? 'active' : 'inactive' }}">
                                {{ $item->is_home ? 'Evet' : 'Hayır' }}
                            </span>
                        </td>
                        <td>{{ $item->created_at->format('d.m.Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            Gösterilecek haber bulunamadı.
        </div>
    @endif

    <div class="footer">
        <p>Bu rapor {{ config('app.name') }} sistemi tarafından oluşturulmuştur.</p>
    </div>
</body>

</html>
