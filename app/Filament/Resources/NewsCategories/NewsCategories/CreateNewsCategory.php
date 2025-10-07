<?php

namespace App\Filament\Resources\NewsCategories\NewsCategories;

use App\Filament\Resources\NewsCategories\NewsCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsCategory extends CreateRecord
{
    protected static string $resource = NewsCategoryResource::class;
}
