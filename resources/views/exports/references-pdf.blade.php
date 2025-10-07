<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Referanslar Raporu</title>
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
        <h1>Referanslar Raporu</h1>
        <p>Rapor Tarihi: {{ now()->format('d.m.Y H:i') }}</p>
        <p>Toplam Referans: {{ $references->count() }}</p>
    </div>
    @if ($references->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Başlık</th>
                    <th>Website URL</th>
                    <th>Hizmetler</th>
                    <th>Durumu</th>
                    <th>Anasayfa</th>
                    <th>Sıra</th>
                    <th>Oluşturulma</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($references as $reference)
                    <tr>
                        <td>{{ $reference->id }}</td>
                        <td>{{ $reference->title }}</td>
                        <td>{{ $reference->url ?: '-' }}</td>
                        <td>{{ $reference->services_text ?: '-' }}</td>
                        <td>
                            <span class="status-{{ $reference->is_active ? 'active' : 'inactive' }}">
                                {{ $reference->is_active ? 'Aktif' : 'Pasif' }}
                            </span>
                        </td>
                        <td>
                            <span class="status-{{ $reference->is_home ? 'active' : 'inactive' }}">
                                {{ $reference->is_home ? 'Evet' : 'Hayır' }}
                            </span>
                        </td>
                        <td>{{ $reference->sort_order }}</td>
                        <td>{{ $reference->created_at->format('d.m.Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            Gösterilecek referans bulunamadı.
        </div>
    @endif
    <div class="footer">
        <p>Bu rapor {{ config('app.name') }} sistemi tarafından oluşturulmuştur.</p>
    </div>
</body>

</html>
