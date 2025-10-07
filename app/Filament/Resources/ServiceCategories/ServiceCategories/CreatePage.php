<?php

namespace App\Filament\Resources\ServiceCategories\ServiceCategories;

use App\Filament\Resources\ServiceCategories\ServiceCategoryResource;
use App\Models\Service;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = ServiceCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
