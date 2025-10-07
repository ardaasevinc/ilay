<?php

namespace App\Filament\Resources\ServiceCategories;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use App\Models\ServiceCategory;
use App\Filament\Resources\ServiceCategories\Schemas\ServiceCategoryForm;
use App\Filament\Resources\ServiceCategories\ServiceCategories\CreatePage;
use App\Filament\Resources\ServiceCategories\ServiceCategories\EditPage;
use App\Filament\Resources\ServiceCategories\ServiceCategories\ListPage;
use App\Filament\Resources\ServiceCategories\Tables\ServiceCategoryTable;

class ServiceCategoryResource extends Resource
{
    protected static ?string $model = ServiceCategory::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|UnitEnum|null $navigationGroup = 'İçerik Yönetimi';

    protected static ?string $navigationLabel = 'Hizmet Kategori';

    protected static ?string $modelLabel = 'Hizmet Kategorisi';

    protected static ?string $pluralModelLabel = 'Hizmet Kategorileri';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return ServiceCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceCategoryTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPage::route('/'),
            'create' => CreatePage::route('/create'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
}
