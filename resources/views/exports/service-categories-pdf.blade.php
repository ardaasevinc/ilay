<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Hizmet Kategorileri Listesi</title>
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
    </style>
</head>

<body>
    <div class="header">
        <h1>Hizmet Kategorileri Listesi</h1>
        <p>Rapor Tarihi: {{ now()->format('d.m.Y H:i') }}</p>
        <p>Toplam Kategori: {{ $categories->count() }}</p>
    </div>

    @if ($categories->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 4%">ID</th>
                    <th style="width: 6%">Görsel</th>
                    <th style="width: 15%">Kategori Adı</th>
                    <th style="width: 12%">Slug</th>
                    <th style="width: 15%">SEO Başlık</th>
                    <th style="width: 10%">Anahtar Kelimeler</th>
                    <th style="width: 8%">Durum</th>
                    <th style="width: 8%">Sıralama</th>
                    <th style="width: 10%">Yayın Tarihi</th>
                    <th style="width: 12%">Oluşturulma</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->img ? 'Var' : 'Yok' }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->seo_title ?? '-' }}</td>
                        <td>{{ is_array($category->seo_key) ? implode(', ', $category->seo_key) : $category->seo_key ?? '-' }}
                        </td>
                        <td>
                            <span class="status-{{ $category->is_active ? 'active' : 'inactive' }}">
                                {{ $category->is_active ? 'Aktif' : 'Pasif' }}
                            </span>
                        </td>
                        <td>{{ $category->sort_order ?? '-' }}</td>
                        <td>{{ $category->published_at ? $category->published_at->format('d.m.Y') : '-' }}</td>
                        <td>{{ $category->created_at->format('d.m.Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            Gösterilecek kategori bulunamadı.
        </div>
    @endif

    <div class="footer">
        <p>Bu rapor {{ config('app.name') }} sistemi tarafından oluşturulmuştur.</p>
    </div>
</body>

</html>
