<?php

namespace App\Filament\Resources\References\Tables;

use Filament\Actions\Action as ActionsAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ReferencesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->modifyQueryUsing(fn($query) => $query->orderBy('sort_order')->orderBy('created_at', 'desc'))
            ->columns([
                ImageColumn::make('img')
                    ->label('Görsel')
                    ->disk('uploads')
                    ->size(50)
                    ->circular(),

                TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                TextColumn::make('slug')
                    ->label('URL Slug')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Kopyalandı!')
                    ->limit(20),

                TextColumn::make('url')
                    ->label('Website')
                    ->url(fn($record) => $record->url, true)
                    ->limit(30)
                    ->placeholder('Belirtilmemiş'),

                TextColumn::make('services_text')
                    ->label('Hizmetler')
                    ->getStateUsing(fn($record) => $record->limited_services_text ?: '-')
                    ->limit(40)
                    ->tooltip(fn($record) => $record->services_text)
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                IconColumn::make('is_home')
                    ->label('Anasayfa')
                    ->boolean()
                    ->trueIcon('heroicon-o-home')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('primary')
                    ->falseColor('gray'),

                TextColumn::make('sort_order')
                    ->label('Sıra')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Aktif Durumu')
                    ->trueLabel('Sadece Aktif')
                    ->falseLabel('Sadece Pasif')
                    ->native(false),

                TernaryFilter::make('is_home')
                    ->label('Anasayfa Durumu')
                    ->trueLabel('Anasayfada Gösterilenler')
                    ->falseLabel('Anasayfada Gösterilmeyenler')
                    ->native(false),
            ])
            ->actions([

                EditAction::make()
                    ->iconButton(),

                ActionsAction::make('gallery')
                    ->label('Galeri')
                    ->icon('heroicon-o-photo')
                    ->color('info')
                    ->url(fn($record) => \App\Filament\Resources\References\ReferenceResource::getUrl('gallery', ['record' => $record]))
                    ->iconButton(),
                DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
