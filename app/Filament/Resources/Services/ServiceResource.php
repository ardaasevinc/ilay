<?php

namespace App\Filament\Resources\Services;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use App\Models\Service;
use App\Filament\Resources\Services\Schemas\ServiceForm;
use App\Filament\Resources\Services\Service\CreatePage;
use App\Filament\Resources\Services\Service\EditPage;
use App\Filament\Resources\Services\Service\GalleryPage;
use App\Filament\Resources\Services\Service\ListPage;
use App\Filament\Resources\Services\Tables\ServiceTable;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-squares-plus';

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|UnitEnum|null $navigationGroup = 'İçerik Yönetimi';

    protected static ?string $navigationLabel = 'Hizmetler';

    protected static ?string $modelLabel = 'Hizmetler';

    protected static ?string $pluralModelLabel = 'Hizmetler';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return ServiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPage::route('/'),
            'create' => CreatePage::route('/create'),
            'edit' => EditPage::route('/{record}/edit'),
            'gallery' => GalleryPage::route('/{record}/gallery'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
}
