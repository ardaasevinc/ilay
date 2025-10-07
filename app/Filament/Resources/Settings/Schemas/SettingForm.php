<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextInput::make('key')
                            ->label('Anahtar')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('name')
                            ->label('Görünen Ad')
                            ->required()
                            ->maxLength(255),

                        Select::make('type')
                            ->label('Tür')
                            ->options([
                                'text' => 'Metin',
                                'textarea' => 'Çok Satırlı Metin',
                                'email' => 'E-posta',
                                'url' => 'URL',
                                'number' => 'Sayı',
                                'boolean' => 'Açık/Kapalı',
                                'select' => 'Seçenek Listesi',
                                'image' => 'Resim',
                            ])
                            ->required()
                            ->reactive(),

                        Select::make('group')
                            ->label('Grup')
                            ->options([
                                'general' => 'Genel',
                                'contact' => 'İletişim',
                                'social' => 'Sosyal Medya',
                                'seo' => 'SEO',
                                'appearance' => 'Görünüm',
                                'mail' => 'E-posta',
                                'system' => 'Sistem',
                            ])
                            ->required(),

                        TextInput::make('order')
                            ->label('Sıra')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_public')
                            ->label('Herkese Açık')
                            ->default(true),
                    ]),

                // Dinamik değer alanı
                TextInput::make('value_text')
                    ->label('Değer')
                    ->visible(fn(callable $get) => in_array($get('type'), ['text', 'email', 'url', 'number']))
                    ->required(fn(callable $get) => in_array($get('type'), ['text', 'email', 'url', 'number']))
                    ->email(fn(callable $get) => $get('type') === 'email')
                    ->url(fn(callable $get) => $get('type') === 'url')
                    ->numeric(fn(callable $get) => $get('type') === 'number')
                    ->dehydrateStateUsing(fn($state) => $state)
                    ->afterStateHydrated(function ($state, callable $set, $record) {
                        if ($record && in_array($record->type, ['text', 'email', 'url', 'number'])) {
                            $set('value_text', $record->value);
                        }
                    }),

                Textarea::make('value_textarea')
                    ->label('Değer')
                    ->visible(fn(callable $get) => $get('type') === 'textarea')
                    ->required(fn(callable $get) => $get('type') === 'textarea')
                    ->rows(3)
                    ->dehydrateStateUsing(fn($state) => $state)
                    ->afterStateHydrated(function ($state, callable $set, $record) {
                        if ($record && $record->type === 'textarea') {
                            $set('value_textarea', $record->value);
                        }
                    }),

                Toggle::make('value_boolean')
                    ->label('Değer')
                    ->visible(fn(callable $get) => $get('type') === 'boolean')
                    ->dehydrateStateUsing(fn($state) => $state ? '1' : '0')
                    ->afterStateHydrated(function ($state, callable $set, $record) {
                        if ($record && $record->type === 'boolean') {
                            $set('value_boolean', (bool) $record->value);
                        }
                    }),

                Select::make('value_select')
                    ->label('Değer')
                    ->visible(fn(callable $get) => $get('type') === 'select')
                    ->options(fn(callable $get, $record) => $record ? $record->options_array : [])
                    ->required(fn(callable $get) => $get('type') === 'select')
                    ->dehydrateStateUsing(fn($state) => $state)
                    ->afterStateHydrated(function ($state, callable $set, $record) {
                        if ($record && $record->type === 'select') {
                            $set('value_select', $record->value);
                        }
                    }),

                FileUpload::make('value_image')
                    ->label('Resim')
                    ->image()
                    ->disk('uploads')
                    ->directory('settings')
                    ->visible(fn(callable $get) => $get('type') === 'image')
                    ->dehydrateStateUsing(fn($state) => $state)
                    ->afterStateHydrated(function ($state, callable $set, $record) {
                        if ($record && $record->type === 'image') {
                            $set('value_image', $record->value);
                        }
                    }),

                Textarea::make('options')
                    ->label('Seçenekler')
                    ->visible(fn(callable $get) => $get('type') === 'select')
                    ->helperText('Her satıra bir seçenek yazın. Format: anahtar: değer')
                    ->placeholder("option1: Seçenek 1\noption2: Seçenek 2")
                    ->rows(3),
            ]);
    }
}
