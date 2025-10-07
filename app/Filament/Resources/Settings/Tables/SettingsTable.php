<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn($query) => $query->orderBy('group')->orderBy('order'))
            ->columns([
                TextColumn::make('name')
                    ->label('Görünen Ad')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('key')
                    ->label('Anahtar')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->fontFamily('mono'),

                TextColumn::make('group')
                    ->label('Grup')
                    ->badge()
                    ->formatStateUsing(fn(?string $state): string => match ($state) {
                        'general' => 'Genel',
                        'contact' => 'İletişim',
                        'social' => 'Sosyal',
                        'seo' => 'SEO',
                        'appearance' => 'Görünüm',
                        'mail' => 'E-posta',
                        'system' => 'Sistem',
                        default => $state ?? '-',
                    })
                    ->color(fn(?string $state): string => match ($state) {
                        'general' => 'gray',
                        'contact' => 'blue',
                        'social' => 'green',
                        'seo' => 'orange',
                        'appearance' => 'purple',
                        'mail' => 'red',
                        'system' => 'indigo',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Tür')
                    ->badge()
                    ->formatStateUsing(fn(?string $state): string => match ($state) {
                        'text' => 'Metin',
                        'textarea' => 'Çok Satırlı',
                        'email' => 'E-posta',
                        'url' => 'URL',
                        'number' => 'Sayı',
                        'boolean' => 'Açık/Kapalı',
                        'select' => 'Seçenek',
                        'image' => 'Resim',
                        default => $state ?? '-',
                    }),

                TextColumn::make('value')
                    ->label('Değer')
                    ->limit(50)
                    ->formatStateUsing(function ($record, $state) {
                        if (!$record || !$record->type) {
                            return $state;
                        }
                        if ($record->type === 'boolean') {
                            return $state === '1' ? 'Açık' : 'Kapalı';
                        }
                        if ($record->type === 'image' && $state) {
                            return 'Resim yüklendi';
                        }
                        return $state;
                    }),

                ImageColumn::make('value')
                    ->label('Resim')
                    ->disk('uploads')
                    ->height(40)
                    ->width(40)
                    ->visible(fn($record) => $record && $record->type === 'image'),

                IconColumn::make('is_public')
                    ->label('Herkese Açık')
                    ->boolean()
                    ->trueIcon('heroicon-o-eye')
                    ->falseIcon('heroicon-o-eye-slash')
                    ->trueColor('success')
                    ->falseColor('gray'),

                TextColumn::make('order')
                    ->label('Sıra')
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('gray'),
            ])
            ->filters([
                SelectFilter::make('type')
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
                    ]),

                SelectFilter::make('is_public')
                    ->label('Görünürlük')
                    ->options([
                        1 => 'Herkese Açık',
                        0 => 'Yalnızca Admin',
                    ]),
            ])
            ->recordActions([
                EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->iconButton()
                    ->tooltip('Düzenle'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('group', 'asc')
            ->defaultPaginationPageOption(25);
    }
}
