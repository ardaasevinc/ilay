<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Abonelikler Raporu</title>
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

        .subscription {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .email {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .date {
            color: #666;
            font-size: 11px;
        }

        .ip-address {
            color: #999;
            font-size: 10px;
            margin-top: 5px;
        }

        .stats {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .stat-item {
            display: inline-block;
            margin: 0 20px;
        }

        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            display: block;
        }

        .stat-label {
            font-size: 11px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Bülten Abonelikleri Raporu</h1>
        <p>Oluşturulma: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="stats">
        <div class="stat-item">
            <span class="stat-number">{{ $subscriptions->count() }}</span>
            <span class="stat-label">Toplam Abone</span>
        </div>
        <div class="stat-item">
            <span
                class="stat-number">{{ $subscriptions->where('created_at', '>=', now()->startOfMonth())->count() }}</span>
            <span class="stat-label">Bu Ay</span>
        </div>
        <div class="stat-item">
            <span
                class="stat-number">{{ $subscriptions->where('created_at', '>=', now()->startOfWeek())->count() }}</span>
            <span class="stat-label">Bu Hafta</span>
        </div>
    </div>

    @foreach ($subscriptions as $subscription)
        <div class="subscription">
            <div class="email">{{ $subscription->email }}</div>
            <div class="date">Abonelik Tarihi: {{ $subscription->created_at->format('d/m/Y H:i') }}</div>
            @if ($subscription->ip_address)
                <div class="ip-address">IP: {{ $subscription->ip_address }}</div>
            @endif
        </div>
    @endforeach

    <div style="margin-top: 30px; text-align: center; color: #666; font-size: 10px;">
        Rapor {{ now()->format('d/m/Y H:i') }} tarihinde oluşturulmuştur.
    </div>
</body>

</html>
