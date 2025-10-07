<?php

namespace App\Filament\Resources\Subscriptions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')
                    ->label('E-posta Adresi')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('E-posta kopyalandı!')
                    ->icon('heroicon-m-envelope'),

                TextColumn::make('ip_address')
                    ->label('IP Adresi')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Abonelik Tarihi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->since(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('created_at_range')
                    ->label('Abonelik Tarihi Aralığı')
                    ->form([
                        DatePicker::make('from')
                            ->label('Başlangıç Tarihi')
                            ->placeholder('dd/mm/yyyy')
                            ->native(false),
                        DatePicker::make('until')
                            ->label('Bitiş Tarihi')
                            ->placeholder('dd/mm/yyyy')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['from']) {
                            $indicators[] = 'Başlangıç: ' . \Carbon\Carbon::parse($data['from'])->format('d/m/Y');
                        }

                        if ($data['until']) {
                            $indicators[] = 'Bitiş: ' . \Carbon\Carbon::parse($data['until'])->format('d/m/Y');
                        }

                        return $indicators;
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
