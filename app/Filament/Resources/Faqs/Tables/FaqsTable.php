<?php

namespace App\Filament\Resources\Faqs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class FaqsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('question')
                    ->label('Soru')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),

                TextColumn::make('answer')
                    ->label('Cevap')
                    ->formatStateUsing(fn(string $state): string => strip_tags($state))
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = strip_tags($column->getState());
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    })
                    ->wrap(),

                TextColumn::make('sort_order')
                    ->label('Sıra')
                    ->sortable()
                    ->alignCenter(),

                IconColumn::make('is_active')
                    ->label('Durum')
                    ->boolean()
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('published_at')
                    ->label('Yayın Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(),

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
                SelectFilter::make('is_active')
                    ->label('Durum')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Pasif',
                    ]),
                TrashedFilter::make(),
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
                    ->modalHeading('FAQ Sil')
                    ->modalDescription('Bu FAQ\'ı silmek istediğinizden emin misiniz?')
                    ->modalSubmitActionLabel('Evet, Sil'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
