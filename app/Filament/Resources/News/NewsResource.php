<?php

namespace App\Filament\Resources\News;

use App\Filament\Resources\News\News\CreateNews;
use App\Filament\Resources\News\News\EditNews;
use App\Filament\Resources\News\News\GalleryNews;
use App\Filament\Resources\News\News\ListNews;
use App\Filament\Resources\News\Schemas\NewsForm;
use App\Filament\Resources\News\Tables\NewsTable;
use App\Models\News;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|UnitEnum|null $navigationGroup = 'İçerik Yönetimi';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Blog';

    protected static ?string $modelLabel = 'Blog';

    protected static ?string $pluralModelLabel = 'Bloglar';

    public static function form(Schema $schema): Schema
    {
        return NewsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NewsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNews::route('/'),
            'create' => CreateNews::route('/create'),
            'edit' => EditNews::route('/{record}/edit'),
            'gallery' => GalleryNews::route('/{record}/gallery'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
}
