<?php

namespace App\Filament\Resources\BrandBriefs\Pages;

use App\Filament\Resources\BrandBriefs\BrandBriefResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBrandBrief extends ViewRecord
{
    protected static string $resource = BrandBriefResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
