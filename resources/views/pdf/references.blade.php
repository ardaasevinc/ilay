<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        }

        .header h1 {
            color: #333;
            margin: 0;
        }

        .meta {
            color: #666;
            margin-top: 5px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status.active {
            color: green;
            font-weight: bold;
        }

        .status.inactive {
            color: red;
        }

        .yes {
            color: green;
        }

        .no {
            color: #999;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Referanslar Raporu</h1>
        <div class="meta">{{ now()->format('d.m.Y H:i') }} tarihinde oluşturuldu</div>
        <div class="meta">Toplam {{ $references->count() }} referans</div>
    </div>

    <table class="table">
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
                        <span class="status {{ $reference->is_active ? 'active' : 'inactive' }}">
                            {{ $reference->is_active ? 'Aktif' : 'Pasif' }}
                        </span>
                    </td>
                    <td>
                        <span class="{{ $reference->is_home ? 'yes' : 'no' }}">
                            {{ $reference->is_home ? 'Evet' : 'Hayır' }}
                        </span>
                    </td>
                    <td>{{ $reference->sort_order }}</td>
                    <td>{{ $reference->created_at->format('d.m.Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Bu rapor otomatik olarak oluşturulmuştur.</p>
    </div>
</body>

</html>
