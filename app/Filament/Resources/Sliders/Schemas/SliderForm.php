<?php

namespace App\Filament\Resources\Sliders\Schemas;

use App\Models\News;
use App\Models\Page;
use App\Models\Slider;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Slider Bilgileri')
                    ->description('Slider görseli ve içerik bilgilerini girin')
                    ->schema([
                        FileUpload::make('img')
                            ->label('Slider Görseli')
                            ->image()
                            ->required()
                            ->disk('uploads')
                            ->directory(directory: 'sliders')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                            ])
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Önerilen boyut: 1920x1080px. Maksimum 5MB.')
                            ->columnSpanFull(),

                        TextInput::make('title')
                            ->label('Başlık')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Açıklama')
                            ->required()
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Maksimum 500 karakter')
                            ->columnSpanFull(),
                    ]),

                Section::make('Yönlendirme Ayarları')
                    ->description('Slider tıklandığında yönlendirme türünü belirleyin')
                    ->schema([
                        Select::make('type_id')
                            ->label('Yönlendirme Türü')
                            ->required()
                            ->options(Slider::getTypes())
                            ->default(1)
                            ->live()
                            ->helperText('Slider tıklandığında nereye yönlendirilsin?'),

                        TextInput::make('type_content')
                            ->label('URL')
                            ->url()
                            ->maxLength(255)
                            ->helperText('Örnek: https://example.com')
                            ->visible(fn($get) => $get('type_id') == 1),

                        Select::make('type_content')
                            ->label('Sayfa Seç')
                            ->searchable()
                            ->options(fn() => Page::active()->pluck('title', 'id')->toArray())
                            ->visible(fn($get) => $get('type_id') == 2)
                            ->helperText('Yönlendirme yapılacak sayfayı seçin'),

                        Select::make('type_content')
                            ->label('Haber Seç')
                            ->searchable()
                            ->options(fn() => News::active()->pluck('title', 'id')->toArray())
                            ->visible(fn($get) => $get('type_id') == 3)
                            ->helperText('Yönlendirme yapılacak haberi seçin'),
                    ]),

                Section::make('Ayarlar')
                    ->description('Slider durumu ve sıralama ayarları')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('sort_order')
                                    ->label('Sıra No')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->helperText('Düşük numara önce gösterilir'),

                                Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->default(true)
                                    ->helperText('Bu slider sitede görünür olsun mu?'),
                            ]),
                    ]),
            ]);
    }
}
