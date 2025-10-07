<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->circular()
                    ->size(40)
                    ->getStateUsing(function ($record) {
                        return $record->avatar
                            ? asset('uploads/' . $record->avatar)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($record->name ?? 'User') . '&background=6366f1&color=fff';
                    }),

                TextColumn::make('name')
                    ->label('Ad Soyad')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('E-posta')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('phone')
                    ->label('Telefon')
                    ->searchable()
                    ->placeholder('Telefon girilmemiş'),

                TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'passive' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'active' => 'Aktif',
                        'pending' => 'Beklemede',
                        'passive' => 'Pasif',
                        default => $state,
                    }),

                TextColumn::make('roles.name')
                    ->label('Yetkiler')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'super_admin' => 'Süper Admin',
                        'admin' => 'Admin',
                        'editor' => 'Editör',
                        'student' => 'Öğrenci',
                        default => $state,
                    }),

                TextColumn::make('last_login_at')
                    ->label('Son Giriş')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('Hiç giriş yapmamış'),

                TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Güncellenme')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Durum')
                    ->options([
                        'active' => 'Aktif',
                        'pending' => 'Beklemede',
                        'passive' => 'Pasif',
                    ]),

                SelectFilter::make('roles')
                    ->label('Rol')
                    ->relationship('roles', 'name')
                    ->options([
                        'super_admin' => 'Süper Admin',
                        'admin' => 'Admin',
                        'editor' => 'Editör',
                        'student' => 'Öğrenci',
                    ]),

                Filter::make('created_at')
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

                TrashedFilter::make()
                    ->label('Silinmiş Kayıtlar'),
            ])
            ->actions([
                Action::make('edit')
                    ->icon('heroicon-o-pencil')
                    ->iconButton()
                    ->tooltip('Düzenle')
                    ->url(fn($record) => "/admin/users/{$record->id}/edit"),

                Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Sil')
                    ->iconButton()
                    ->requiresConfirmation()
                    ->action(fn($record) => $record->delete()),

                Action::make('restore')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('warning')
                    ->iconButton()
                    ->tooltip('Geri Yükle')
                    ->visible(fn($record) => $record->trashed())
                    ->action(fn($record) => $record->restore()),

                Action::make('forceDelete')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->iconButton()
                    ->tooltip('Kalıcı Sil')
                    ->visible(fn($record) => $record->trashed())
                    ->requiresConfirmation()
                    ->action(fn($record) => $record->forceDelete()),
            ])
            ->defaultPaginationPageOption(10)
            ->paginationPageOptions([10, 25, 50, 100, 'all'])
            ->paginated(true);
    }
}
