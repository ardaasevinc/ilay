<?php

namespace App\Filament\Resources\EmailLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Actions\Action;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use App\Exports\EmailLogsExport;

class EmailLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type_label')
                    ->label('Tür')
                    ->searchable(false)
                    ->sortable(false)
                    ->badge()
                    ->color(fn(string $state, $record) => match ($record->type) {
                        'contact' => Color::Blue,
                        'brand_brief' => Color::Purple,
                        'subscription' => Color::Green,
                        default => Color::Gray,
                    }),

                TextColumn::make('to_email')
                    ->label('Alıcı')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('E-posta adresi kopyalandı'),

                TextColumn::make('subject')
                    ->label('Konu')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    }),

                BadgeColumn::make('status')
                    ->label('Durum')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'sent' => 'Gönderildi',
                        'failed' => 'Başarısız',
                        default => ucfirst($state),
                    })
                    ->colors([
                        'success' => 'sent',
                        'danger' => 'failed',
                    ])
                    ->icons([
                        'success' => Heroicon::OutlinedCheckCircle,
                        'danger' => Heroicon::OutlinedXCircle,
                    ]),

                TextColumn::make('sent_at')
                    ->label('Gönderim Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Tür')
                    ->options([
                        'contact' => 'İletişim Formu',
                        'brand_brief' => 'Marka Analizi',
                        'subscription' => 'E-bülten Aboneliği',
                    ]),

                SelectFilter::make('status')
                    ->label('Durum')
                    ->options([
                        'sent' => 'Gönderildi',
                        'failed' => 'Başarısız',
                    ]),

                Filter::make('created_from')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Oluşturulma Başlangıç'),
                        DatePicker::make('created_until')
                            ->label('Oluşturulma Bitiş'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn($query, $date) => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn($query, $date) => $query->whereDate('created_at', '<=', $date),
                            );
                    }),

                Filter::make('sent_from')
                    ->form([
                        DatePicker::make('sent_from')
                            ->label('Gönderim Başlangıç'),
                        DatePicker::make('sent_until')
                            ->label('Gönderim Bitiş'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['sent_from'],
                                fn($query, $date) => $query->whereDate('sent_at', '>=', $date),
                            )
                            ->when(
                                $data['sent_until'],
                                fn($query, $date) => $query->whereDate('sent_at', '<=', $date),
                            );
                    }),
            ])
            ->recordActions([
                ViewAction::make()
                    ->iconButton()
                    ->tooltip('Detayları Görüntüle'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}
