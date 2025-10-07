<?php

namespace App\Filament\Resources\References;

use App\Filament\Resources\References\Pages\CreateReference;
use App\Filament\Resources\References\Pages\EditReference;
use App\Filament\Resources\References\Pages\ListReferences;
use App\Filament\Resources\References\Pages\GalleryReference;
use App\Filament\Resources\References\Schemas\ReferenceForm;
use App\Filament\Resources\References\Tables\ReferencesTable;
use App\Models\Reference;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ReferenceResource extends Resource
{
    protected static ?string $model = Reference::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Referanslar';

    protected static ?string $modelLabel = 'Referans';

    protected static ?string $pluralModelLabel = 'Referanslar';

    protected static string|UnitEnum|null $navigationGroup = 'İçerik Yönetimi';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return ReferenceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReferencesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReferences::route('/'),
            'create' => CreateReference::route('/create'),
            'edit' => EditReference::route('/{record}/edit'),
            'gallery' => GalleryReference::route('/{record}/gallery'),
        ];
    }
}
