<?php

namespace App\Filament\Widgets;

use App\Models\BrandBrief;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class BrandBriefStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    protected null|string $heading = 'Marka Brief Formları';

    protected function getStats(): array
    {
        $now = now();
        $startThis = $now->copy()->subDays(7);
        $startPrev = $now->copy()->subDays(14);
        $midPrev = $now->copy()->subDays(7);

        $brandBriefTotal = BrandBrief::count();
        $brandBriefRead = BrandBrief::where('status', true)->count();
        $brandBriefUnread = $brandBriefTotal - $brandBriefRead;

        // Trend hesaplama
        $brandBriefPrev = BrandBrief::whereBetween('created_at', [$startPrev, $midPrev])->count();
        $brandBriefCurr = BrandBrief::whereBetween('created_at', [$midPrev, $now])->count();
        $brandBriefDelta = $brandBriefCurr - $brandBriefPrev;
        $brandBriefPct = $brandBriefPrev > 0 ? round(($brandBriefDelta / $brandBriefPrev) * 100, 1) : ($brandBriefCurr > 0 ? 100 : 0);

        // Sparkline verileri
        $brandBriefChart = DB::table('brand_briefs')
            ->selectRaw("DATE(created_at) as d, COUNT(*) as c")
            ->whereBetween('created_at', [$startThis->startOfDay(), $now])
            ->groupBy('d')
            ->orderBy('d')
            ->pluck('c')
            ->toArray();

        return [
            Stat::make('Toplam Brief', (string) $brandBriefTotal)
                ->icon('heroicon-o-document-text')
                ->description($this->desc($brandBriefDelta, $brandBriefPct))
                ->descriptionIcon($brandBriefDelta >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color('primary')
                ->chart($brandBriefChart),

            Stat::make('İncelenmiş', (string) $brandBriefRead)
                ->icon('heroicon-o-check-badge')
                ->description('Tamamlanan analizler')
                ->color('success'),

            Stat::make('Bekleyen', (string) $brandBriefUnread)
                ->icon('heroicon-o-clock')
                ->description('Analiz bekleyen')
                ->color($brandBriefUnread > 0 ? 'warning' : 'success'),
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
