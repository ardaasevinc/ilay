<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('list')
                ->label('Sayfa Yönetim Listesi')
                ->icon('heroicon-o-list-bullet')
                ->color('gray')
                ->url(static::getResource()::getUrl('index')),

            Action::make('create')
                ->label('Yeni Sayfa')
                ->icon('heroicon-o-plus')
                ->color('success')
                ->url(static::getResource()::getUrl('create')),

            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
