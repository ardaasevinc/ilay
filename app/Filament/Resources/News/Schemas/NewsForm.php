<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Haber İçeriği')
                ->schema([
                    FileUpload::make('img')
                        ->label('Kapak Görseli')
                        ->disk('uploads')
                        ->directory('news')
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
                        ->previewable(),

                    Select::make('news_category_id')
                        ->label('Haber Kategorisi')
                        ->relationship('news_category', 'title')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            TextInput::make('title')->required()->label('Kategori Adı'),
                            TextInput::make('slug')->required()->label('URL Slug'),
                        ])
                        ->createOptionUsing(function (array $data) {
                            $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
                            return \App\Models\NewsCategory::create($data);
                        })
                        ->native(false),

                    TextInput::make('title')
                        ->label('Haber Başlığı')
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

                    RichEditor::make('desc')
                        ->label('Haber İçeriği')
                        ->required()
                        ->fileAttachmentsDisk('uploads')
                        ->fileAttachmentsDirectory('news/attachments')
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

            Section::make('Haber Ayarları')
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
                        ]),
                ])->columnSpan(1),
        ])->columns(3);
    }
}
