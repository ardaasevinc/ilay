<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Hizmetler Listesi</title>
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

        .category {
            background-color: #f3f4f6;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            display: inline-block;
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
    </style>
</head>

<body>
    <div class="header">
        <h1>Hizmetler Listesi</h1>
        <p>Rapor Tarihi: {{ now()->format('d.m.Y H:i') }}</p>
        <p>Toplam Hizmet: {{ $services->count() }}</p>
    </div>

    @if ($services->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 3%">ID</th>
                    <th style="width: 5%">Görsel</th>
                    <th style="width: 18%">Hizmet Başlığı</th>
                    <th style="width: 12%">Slug</th>
                    <th style="width: 12%">Kategori</th>
                    <th style="width: 12%">SEO Başlık</th>
                    <th style="width: 8%">Durum</th>
                    <th style="width: 8%">Ana Sayfa</th>
                    <th style="width: 8%">Sıralama</th>
                    <th style="width: 8%">Yayın Tarihi</th>
                    <th style="width: 6%">Oluşturulma</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->img ? 'Var' : 'Yok' }}</td>
                        <td>{{ $service->title }}</td>
                        <td>{{ $service->slug }}</td>
                        <td>
                            @if ($service->service_category)
                                <span class="category">{{ $service->service_category->title }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $service->seo_title ?? '-' }}</td>
                        <td>
                            <span class="status-{{ $service->is_active ? 'active' : 'inactive' }}">
                                {{ $service->is_active ? 'Aktif' : 'Pasif' }}
                            </span>
                        </td>
                        <td>
                            <span class="status-{{ $service->is_home ? 'active' : 'inactive' }}">
                                {{ $service->is_home ? 'Evet' : 'Hayır' }}
                            </span>
                        </td>
                        <td>{{ $service->sort_order ?? '-' }}</td>
                        <td>{{ $service->published_at ? $service->published_at->format('d.m.Y') : '-' }}</td>
                        <td>{{ $service->created_at->format('d.m.Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            Gösterilecek hizmet bulunamadı.
        </div>
    @endif

    <div class="footer">
        <p>Bu rapor {{ config('app.name') }} sistemi tarafından oluşturulmuştur.</p>
    </div>
</body>

</html>
