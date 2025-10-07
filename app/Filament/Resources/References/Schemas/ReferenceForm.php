<?php

namespace App\Filament\Resources\References\Schemas;

use App\Models\Service;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ReferenceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Referans İçeriği')
                ->schema([
                    FileUpload::make('img')
                        ->label('Kapak Görseli')
                        ->disk('uploads')
                        ->directory('references')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                        ->imageResizeTargetWidth(1200)
                        ->imageResizeTargetHeight(675)
                        ->maxSize(5120)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Önerilen boyut: 1200x675 (16:9)')
                        ->visibility('public')
                        ->downloadable()
                        ->previewable()
                        ->required(),
                    Select::make('services')
                        ->label('Verilen Hizmetler')
                        ->multiple()
                        ->relationship('services', 'title')
                        ->options(Service::where('is_active', true)->pluck('title', 'id'))
                        ->searchable()
                        ->preload()
                        ->helperText('Bu referansta hangi hizmetler verildi?')
                        ->columnSpanFull(),
                    TextInput::make('title')
                        ->label('Referans Başlığı')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, callable $set) {
                            if ($operation === 'create' || !$state) {
                                $set('slug', Str::slug($state));
                            }
                        }),

                    TextInput::make('slug')
                        ->label('URL Slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->rule('alpha_dash')
                        ->helperText('SEO dostu URL için kullanılır')
                        ->dehydrateStateUsing(fn($state, $get) => $state ?: Str::slug($get('title')))
                        ->readonly(),

                    TextInput::make('url')
                        ->label('Website URL')
                        ->url()
                        ->maxLength(255)
                        ->helperText('Referansın web sitesi adresi'),

                    RichEditor::make('desc')
                        ->label('Referans Açıklaması')
                        ->required()
                        ->fileAttachmentsDisk('uploads')
                        ->fileAttachmentsDirectory('references/attachments')
                        ->fileAttachmentsVisibility('public')
                        ->toolbarButtons([
                            'attachFiles',
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            'h2',
                            'h3',
                            'blockquote',
                            'codeBlock',
                            'orderedList',
                            'bulletList',
                            'link',
                            'horizontalRule',
                            'undo',
                            'redo'
                        ])
                        ->extraAttributes(['style' => 'min-height: 350px;']),
                ])->columnSpan(2),

            Section::make('Referans Ayarları')
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

                            Toggle::make('is_home')
                                ->label('Anasayfada Göster')
                                ->default(false)
                                ->helperText('Anasayfada öne çıkarılsın mı?'),

                            TextInput::make('sort_order')
                                ->label('Sıra')
                                ->numeric()
                                ->default(0)
                                ->helperText('Düşük sayı önce görüntülenir'),
                        ]),
                ])->columnSpan(1),
        ])->columns(3);
    }
}
