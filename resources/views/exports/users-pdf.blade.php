<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Listesi</title>
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

        .status-pending {
            color: #d97706;
            font-weight: bold;
        }

        .status-passive {
            color: #dc2626;
            font-weight: bold;
        }

        .role {
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
        <h1>Kullanıcı Listesi</h1>
        <p>Rapor Tarihi: {{ now()->format('d.m.Y H:i') }}</p>
        <p>Toplam Kullanıcı: {{ $users->count() }}</p>
    </div>

    @if ($users->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 5%">ID</th>
                    <th style="width: 20%">Ad Soyad</th>
                    <th style="width: 25%">E-posta</th>
                    <th style="width: 15%">Telefon</th>
                    <th style="width: 10%">Durum</th>
                    <th style="width: 15%">Rol</th>
                    <th style="width: 10%">Oluşturulma</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td>
                            <span class="status-{{ $user->status }}">
                                {{ match ($user->status) {
                                    'active' => 'Aktif',
                                    'pending' => 'Beklemede',
                                    'passive' => 'Pasif',
                                    default => $user->status,
                                } }}
                            </span>
                        </td>
                        <td>
                            @foreach ($user->roles as $role)
                                <span class="role">
                                    {{ match ($role->name) {
                                        'super_admin' => 'Süper Admin',
                                        'admin' => 'Admin',
                                        'editor' => 'Editör',
                                        'student' => 'Öğrenci',
                                        default => $role->name,
                                    } }}
                                </span>
                                @if (!$loop->last)
                                    <br>
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $user->created_at->format('d.m.Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            Gösterilecek kullanıcı bulunamadı.
        </div>
    @endif

    <div class="footer">
        <p>Bu rapor {{ config('app.name') }} sistemi tarafından oluşturulmuştur.</p>
    </div>
</body>

</html>
