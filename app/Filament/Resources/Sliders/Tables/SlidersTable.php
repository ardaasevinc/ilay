<?php

namespace App\Filament\Resources\Sliders\Tables;

use App\Models\Slider;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SlidersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->columns([
                ImageColumn::make('img')
                    ->label('Görsel')
                    ->disk('uploads')
                    ->height(60)
                    ->width(80)
                    ->extraImgAttributes(['style' => 'object-fit: cover; border-radius: 8px;'])
                    ->defaultImageUrl('/no-image.svg')
                    ->visibility('public'),

                TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 30) {
                            return null;
                        }
                        return $state;
                    }),

                TextColumn::make('type_name')
                    ->label('Yönlendirme Türü')
                    ->badge()
                    ->colors([
                        'primary' => 'Direkt URL',
                        'success' => 'Sayfa',
                        'warning' => 'Haber',
                    ]),

                TextColumn::make('type_content')
                    ->label('Hedef')
                    ->formatStateUsing(function ($state, $record) {
                        return match ($record->type_id) {
                            1 => $state ? (strlen($state) > 30 ? substr($state, 0, 30) . '...' : $state) : '-',
                            2 => $record->page?->title ?? 'Sayfa Bulunamadı',
                            3 => $record->news?->title ?? 'Haber Bulunamadı',
                            default => '-',
                        };
                    })
                    ->limit(30),

                TextColumn::make('sort_order')
                    ->label('Sıra')
                    ->sortable()
                    ->alignCenter(),

                IconColumn::make('is_active')
                    ->label('Durum')
                    ->boolean()
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Oluşturma')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Güncelleme')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type_id')
                    ->label('Yönlendirme Türü')
                    ->options(Slider::getTypes()),

                SelectFilter::make('is_active')
                    ->label('Durum')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Pasif',
                    ]),
            ])
            ->defaultSort('sort_order')
            ->recordActions([
                EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->tooltip('Düzenle')
                    ->label(''),
                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->tooltip('Sil')
                    ->label('')
                    ->requiresConfirmation()
                    ->modalHeading('Slider Sil')
                    ->modalDescription('Bu slider\'ı silmek istediğinizden emin misiniz?')
                    ->modalSubmitActionLabel('Evet, Sil'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
