<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Kategori İçeriği')
                ->schema([
                    FileUpload::make('img')
                        ->label('Kategori Görseli')
                        ->disk('uploads')
                        ->directory('services')
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
                    Select::make('service_category_id')
                        ->label('Hizmet Kategorisi')
                        ->relationship('service_category', 'title')
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

                    RichEditor::make('desc')
                        ->label('Kategori Açıklaması')
                        ->required()
                        ->fileAttachmentsDisk('uploads')
                        ->fileAttachmentsDirectory('services/attachments')
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

                            TextInput::make('sort_order')
                                ->label('Sıralama')
                                ->numeric()
                                ->default(0)
                                ->helperText('Düşük sayılar önce gösterilir'),

                            DateTimePicker::make('published_at')
                                ->label('Yayın Tarihi')
                                ->default(now())
                                ->helperText('Kategori bu tarihten sonra görünür olacak'),
                        ]),
                ])->columnSpan(1),
        ])->columns(3);
    }
}
