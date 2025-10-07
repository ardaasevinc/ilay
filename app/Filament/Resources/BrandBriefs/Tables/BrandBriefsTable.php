<?php

namespace App\Filament\Resources\BrandBriefs\Tables;

use App\Models\BrandBrief;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BrandBriefsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('brand_name')
                    ->label('Marka Adı')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('full_name')
                    ->label('İletişim Kişisi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('E-posta')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('E-posta kopyalandı!')
                    ->icon('heroicon-m-envelope'),

                TextColumn::make('phone')
                    ->label('Telefon')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Telefon kopyalandı!')
                    ->icon('heroicon-m-phone'),

                TextColumn::make('sector')
                    ->label('Sektör')
                    ->searchable()
                    ->badge()
                    ->color('info'),

                BadgeColumn::make('status')
                    ->label('Durum')
                    ->colors([
                        'warning' => BrandBrief::STATUS_PENDING,
                        'info' => BrandBrief::STATUS_IN_REVIEW,
                        'success' => BrandBrief::STATUS_COMPLETED,
                    ])
                    ->formatStateUsing(fn($state) => BrandBrief::getStatusOptions()[$state] ?? $state)
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Gönderilme Tarihi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->since(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Durum')
                    ->options(BrandBrief::getStatusOptions())
                    ->placeholder('Tüm Durumlar'),

                SelectFilter::make('sector')
                    ->label('Sektör')
                    ->options(function () {
                        return BrandBrief::distinct()
                            ->whereNotNull('sector')
                            ->pluck('sector', 'sector')
                            ->toArray();
                    })
                    ->placeholder('Tüm Sektörler'),

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
                    ->iconButton()
                    ->tooltip('Detayları Görüntüle'),
                EditAction::make()
                    ->iconButton()
                    ->tooltip('Düzenle'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Sil'),
                ]),
            ]);
    }
}
