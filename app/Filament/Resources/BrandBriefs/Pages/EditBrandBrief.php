<?php

namespace App\Filament\Resources\BrandBriefs\Pages;

use App\Filament\Resources\BrandBriefs\BrandBriefResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBrandBrief extends EditRecord
{
    protected static string $resource = BrandBriefResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
