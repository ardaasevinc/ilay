<?php

namespace App\Filament\Resources\NewsCategories\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TagsInput;

class NewsCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Kategori İçeriği')
                ->schema([
                    FileUpload::make('img')
                        ->label('Kategori Görseli')
                        ->disk('uploads')
                        ->directory('news-categories')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                        ->imageResizeTargetWidth(800)
                        ->imageResizeTargetHeight(450)
                        ->maxSize(5120)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Önerilen boyut: 800x450 (16:9)')
                        ->visibility('public')
                        ->downloadable()
                        ->previewable(),

                    TextInput::make('title')
                        ->label('Kategori Adı')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, callable $set) {
                            if ($operation === 'create' || !$state) {
                                $set('slug', \Illuminate\Support\Str::slug($state));
                            }
                        }),

                    TextInput::make('slug')
                        ->label('URL Slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->rule('alpha_dash')
                        ->helperText('SEO dostu URL için kullanılır')
                        ->dehydrateStateUsing(fn($state, $get) => $state ?: \Illuminate\Support\Str::slug($get('title')))
                        ->readonly(),
                ])->columnSpan(2),

            Section::make('SEO ve Ayarlar')
                ->schema([
                    Section::make('SEO Ayarları')
                        ->schema([
                            TextInput::make('seo_title')
                                ->label('SEO Başlık')
                                ->maxLength(60)
                                ->helperText('Maksimum 60 karakter'),

                            TagsInput::make('seo_key')
                                ->label('Anahtar Kelimeler')
                                ->separator(',')
                                ->rules(['array', 'max:8'])
                                ->helperText('Maksimum 8 anahtar kelime girebilirsiniz. Enter ile yeni kelime ekleyin.'),

                            Textarea::make('seo_desc')
                                ->label('SEO Açıklama')
                                ->rows(3)
                                ->maxLength(160)
                                ->helperText('Maksimum 160 karakter'),
                        ]),

                    Section::make('Yayın Ayarları')
                        ->schema([
                            Toggle::make('is_active')
                                ->label('Aktif')
                                ->default(true),
                        ]),
                ])->columnSpan(1),
        ])->columns(3);
    }
}
