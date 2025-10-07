<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ContactStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 3;
    protected null|string $heading = 'İletişim Mesajları';

    protected function getStats(): array
    {
        $now = now();
        $startThis = $now->copy()->subDays(7);
        $startPrev = $now->copy()->subDays(14);
        $midPrev = $now->copy()->subDays(7);

        $contactTotal = Contact::count();
        $contactRead = Contact::where('is_read', true)->count();
        $contactUnread = $contactTotal - $contactRead;

        // Trend hesaplama
        $contactPrev = Contact::whereBetween('created_at', [$startPrev, $midPrev])->count();
        $contactCurr = Contact::whereBetween('created_at', [$midPrev, $now])->count();
        $contactDelta = $contactCurr - $contactPrev;
        $contactPct = $contactPrev > 0 ? round(($contactDelta / $contactPrev) * 100, 1) : ($contactCurr > 0 ? 100 : 0);

        // Sparkline verileri
        $contactChart = DB::table('contacts')
            ->selectRaw("DATE(created_at) as d, COUNT(*) as c")
            ->whereBetween('created_at', [$startThis->startOfDay(), $now])
            ->groupBy('d')
            ->orderBy('d')
            ->pluck('c')
            ->toArray();

        return [
            Stat::make('Toplam İletişim', (string) $contactTotal)
                ->icon('heroicon-o-envelope')
                ->description($this->desc($contactDelta, $contactPct))
                ->descriptionIcon($contactDelta >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color('primary')
                ->chart($contactChart),

            Stat::make('Okunmuş', (string) $contactRead)
                ->icon('heroicon-o-envelope-open')
                ->description('Yanıtlanan mesajlar')
                ->color('success'),

            Stat::make('Bekleyen', (string) $contactUnread)
                ->icon('heroicon-o-exclamation-circle')
                ->description('Yanıt bekleyen')
                ->color($contactUnread > 0 ? 'warning' : 'success'),
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
