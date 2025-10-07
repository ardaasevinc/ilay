<?php

namespace App\Filament\Widgets;

use App\Models\Subscription;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class SubscriptionStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 4;
    protected null|string $heading = 'Abonelik İstatistikleri';

    protected function getStats(): array
    {
        $now = now();
        $startThis = $now->copy()->subDays(7);
        $startPrev = $now->copy()->subDays(14);
        $midPrev = $now->copy()->subDays(7);

        $subscriptionTotal = Subscription::count();
        $todayStart = now()->startOfDay();
        $todaySubscriptions = Subscription::where('created_at', '>=', $todayStart)->count();

        // Trend hesaplama
        $subscriptionPrev = Subscription::whereBetween('created_at', [$startPrev, $midPrev])->count();
        $subscriptionCurr = Subscription::whereBetween('created_at', [$midPrev, $now])->count();
        $subscriptionDelta = $subscriptionCurr - $subscriptionPrev;
        $subscriptionPct = $subscriptionPrev > 0 ? round(($subscriptionDelta / $subscriptionPrev) * 100, 1) : ($subscriptionCurr > 0 ? 100 : 0);

        // Sparkline verileri
        $subscriptionChart = DB::table('subscriptions')
            ->selectRaw("DATE(created_at) as d, COUNT(*) as c")
            ->whereBetween('created_at', [$startThis->startOfDay(), $now])
            ->groupBy('d')
            ->orderBy('d')
            ->pluck('c')
            ->toArray();

        return [
            Stat::make('Toplam Abone', (string) $subscriptionTotal)
                ->icon('heroicon-o-users')
                ->description($this->desc($subscriptionDelta, $subscriptionPct))
                ->descriptionIcon($subscriptionDelta >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color('primary')
                ->chart($subscriptionChart),

            Stat::make('Bu Hafta', (string) $subscriptionCurr)
                ->icon('heroicon-o-calendar-days')
                ->description('Son 7 günde')
                ->color($subscriptionCurr > 0 ? 'success' : 'gray'),

            Stat::make('Bugün', (string) $todaySubscriptions)
                ->icon('heroicon-o-sparkles')
                ->description('Bugünkü abonelik')
                ->color($todaySubscriptions > 0 ? 'warning' : 'gray'),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }

    private function desc(int $delta, float $pct): string
    {
        if ($delta === 0) {
            return 'Son 7 günde değişim yok';
        }
        $sign = $delta > 0 ? '+' : '';
        return "Son 7 günde {$sign}{$delta} ({$pct}%)";
    }
}
