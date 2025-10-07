<?php

namespace App\Filament\Resources\News\News;

use App\Filament\Resources\News\NewsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('gallery')
                ->label('Galeri Yönetimi')
                ->icon('heroicon-o-photo')
                ->color('info')
                ->url(fn() => GalleryNews::getUrl(['record' => $this->record])),
            DeleteAction::make(),
        ];
    }
}
