<?php

namespace App\Filament\Resources\Contacts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([
                IconColumn::make('is_read')
                    ->label('Durum')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Ad Soyad')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('E-posta')
                    ->searchable()
                    ->copyable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('Telefon')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('subject')
                    ->label('Konu')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('message')
                    ->label('Mesaj')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->message)
                    ->wrap(),
                TextColumn::make('created_at')
                    ->label('Gönderilme Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
                TextColumn::make('read_at')
                    ->label('Okunma Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->placeholder('Okunmadı'),
            ])
            ->recordAction(null)
            ->filters([
                SelectFilter::make('is_read')
                    ->label('Durum')
                    ->options([
                        1 => 'Okundu',
                        0 => 'Okunmadı',
                    ])
                    ->placeholder('Tüm mesajlar'),
                \Filament\Tables\Filters\Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Başlangıç Tarihi'),
                        DatePicker::make('created_until')
                            ->label('Bitiş Tarihi'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('')
                    ->tooltip('Görüntüle')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->size('sm'),
                EditAction::make()
                    ->label('')
                    ->tooltip('Düzenle')
                    ->icon('heroicon-o-pencil')
                    ->color('warning')
                    ->size('sm'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Seçilenleri Sil'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
