<?php

namespace App\Filament\Resources\BrandBriefs;

use App\Filament\Resources\BrandBriefs\Pages\CreateBrandBrief;
use App\Filament\Resources\BrandBriefs\Pages\EditBrandBrief;
use App\Filament\Resources\BrandBriefs\Pages\ListBrandBriefs;
use App\Filament\Resources\BrandBriefs\Pages\ViewBrandBrief;
use App\Filament\Resources\BrandBriefs\Schemas\BrandBriefForm;
use App\Filament\Resources\BrandBriefs\Tables\BrandBriefsTable;
use App\Models\BrandBrief;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class BrandBriefResource extends Resource
{
    protected static ?string $model = BrandBrief::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $recordTitleAttribute = 'brand_name';

    protected static string|UnitEnum|null $navigationGroup = 'Formlar';

    protected static ?string $navigationLabel = 'Marka Analizleri';

    protected static ?string $modelLabel = 'Marka Analizi';

    protected static ?string $pluralModelLabel = 'Marka Analizleri';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return BrandBriefForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BrandBriefsTable::configure($table);
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
            'index' => ListBrandBriefs::route('/'),
            'create' => CreateBrandBrief::route('/create'),
            'view' => ViewBrandBrief::route('/{record}'),
            'edit' => EditBrandBrief::route('/{record}/edit'),
        ];
    }
}
