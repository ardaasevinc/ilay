<?php

namespace App\Filament\Widgets;

use App\Models\News;
use App\Models\Reference;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 2;
    protected null|string $heading = 'Sistem Özeti';

    protected function getStats(): array
    {
        $now       = now();
        $startThis = $now->copy()->subDays(7);
        $startPrev = $now->copy()->subDays(14);
        $midPrev   = $now->copy()->subDays(7);

        // Ortak yardımcılar
        $trend = function (string $modelClass) use ($startPrev, $midPrev, $now): array {
            $model   = new $modelClass();
            $col     = $model->getCreatedAtColumn();
            $prev    = $modelClass::whereBetween($col, [$startPrev, $midPrev])->count();
            $curr    = $modelClass::whereBetween($col, [$midPrev, $now])->count();
            $delta   = $curr - $prev;
            $pct     = $prev > 0 ? round(($delta / $prev) * 100, 1) : ($curr > 0 ? 100 : 0);
            return [$delta, $pct];
        };

        $spark = function (string $modelClass) use ($startThis, $now): array {
            $model = new $modelClass();
            $table = $model->getTable();
            $col   = $model->getCreatedAtColumn();

            return DB::table($table)
                ->selectRaw("DATE($col) as d, COUNT(*) as c")
                ->whereBetween($col, [$startThis->startOfDay(), $now])
                ->groupBy('d')
                ->orderBy('d')
                ->pluck('c')
                ->toArray();
        };

        $cards = [
            [
                'label' => 'Kullanıcı Sayısı',
                'model' => User::class,
                'icon'  => 'heroicon-o-user-group',
                'value' => (string) User::count(),
            ],
            [
                'label' => 'Haber Sayısı',
                'model' => News::class,
                'icon'  => 'heroicon-o-newspaper',
                'value' => (string) News::count(),
            ],
            [
                'label' => 'Referans Sayısı',
                'model' => Reference::class,
                'icon'  => 'heroicon-o-link',
                'value' => (string) Reference::count(),
            ],
            [
                'label' => 'Hizmet Sayısı',
                'model' => Service::class,
                'icon'  => 'heroicon-o-wrench-screwdriver',
                'value' => (string) Service::count(),
            ],
            [
                'label' => 'Hizmet Kategorisi',
                'model' => ServiceCategory::class,
                'icon'  => 'heroicon-o-rectangle-group',
                'value' => (string) ServiceCategory::count(),
            ],
        ];

        $stats = [];

        foreach ($cards as $c) {
            [$delta, $pct] = $trend($c['model']);

            $stats[] = Stat::make($c['label'], $c['value'])
                ->icon($c['icon'])
                ->description($this->desc($delta, $pct))
                ->descriptionIcon($delta >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color($delta >= 0 ? 'success' : 'danger')
                ->chart($spark($c['model']));
        }

        return $stats;
    }

    protected function getColumns(): int
    {
        return 5; // 5 kutu yan yana
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
