<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use App\Models\Setting;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    public function mount(): void
    {
        parent::mount();

        // URL'den activeTab parametresini al
        $activeTab = request()->get('activeTab');

        if ($activeTab && $this->isValidTab($activeTab)) {
            $this->activeTab = $activeTab;
        } else {
            $this->activeTab = 'general';
        }
    }

    private function isValidTab(string $tab): bool
    {
        $validTabs = ['general', 'contact', 'social', 'seo', 'appearance', 'mail', 'system'];
        return in_array($tab, $validTabs);
    }

    public ?string $activeTab = null;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Yeni Ayar')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTabs(): array
    {
        $counts = $this->getTabCounts();

        return [
            'general' => Tab::make('Genel')
                ->badge($counts['general'])
                ->icon('heroicon-o-cog-6-tooth')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('group', 'general')),

            'contact' => Tab::make('İletişim')
                ->badge($counts['contact'])
                ->icon('heroicon-o-envelope')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('group', 'contact')),

            'social' => Tab::make('Sosyal Medya')
                ->badge($counts['social'])
                ->icon('heroicon-o-share')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('group', 'social')),

            'seo' => Tab::make('SEO')
                ->badge($counts['seo'])
                ->icon('heroicon-o-magnifying-glass')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('group', 'seo')),

            'appearance' => Tab::make('Görünüm')
                ->badge($counts['appearance'])
                ->icon('heroicon-o-paint-brush')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('group', 'appearance')),

            'mail' => Tab::make('E-posta')
                ->badge($counts['mail'])
                ->icon('heroicon-o-at-symbol')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('group', 'mail')),

            'system' => Tab::make('Sistem')
                ->badge($counts['system'])
                ->icon('heroicon-o-server')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('group', 'system')),
        ];
    }

    public function getTabCounts(): array
    {
        return [
            'general' => Setting::where('group', 'general')->count(),
            'contact' => Setting::where('group', 'contact')->count(),
            'social' => Setting::where('group', 'social')->count(),
            'seo' => Setting::where('group', 'seo')->count(),
            'appearance' => Setting::where('group', 'appearance')->count(),
            'mail' => Setting::where('group', 'mail')->count(),
            'system' => Setting::where('group', 'system')->count(),
        ];
    }
}
