<?php

namespace App\Filament\Resources\News\Tables;

use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\BulkActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('img')
                    ->label('Kapak Görseli')
                    ->disk('uploads')
                    ->width(60)
                    ->defaultImageUrl('/favicon.ico'),

                TextColumn::make('title')
                    ->label('Haber Başlığı')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('news_category.title')
                    ->label('Kategori')
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('slug')
                    ->label('URL Slug')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),

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
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                TextColumn::make('galleries_count')
                    ->label('Galeri')
                    ->counts('galleries')
                    ->suffix(' görsel')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Güncellenme')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('news_category_id')
                    ->label('Kategori')
                    ->relationship('news_category', 'title')
                    ->searchable()
                    ->preload()
                    ->placeholder('Tüm Kategoriler')
                    ->native(false),

                SelectFilter::make('is_active')
                    ->label('Durum')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Pasif',
                    ])
                    ->placeholder('Tüm Durumlar')
                    ->native(false),

                SelectFilter::make('is_home')
                    ->label('Anasayfa')
                    ->options([
                        1 => 'Anasayfada',
                        0 => 'Anasayfada Değil',
                    ])
                    ->placeholder('Tüm Haberler')
                    ->native(false),

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
            ])
            ->actions([
                EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->iconButton()
                    ->tooltip('Düzenle'),

                Action::make('gallery')
                    ->icon('heroicon-o-photo')
                    ->iconButton()
                    ->color('info')
                    ->tooltip('Galeri Yönetimi')
                    ->url(fn($record) => \App\Filament\Resources\News\News\GalleryNews::getUrl([
                        'record' => $record,
                    ])),

                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->iconButton()
                    ->tooltip('Sil'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(10)
            ->paginationPageOptions([10, 25, 50, 100, 'all'])
            ->paginated(true);
    }
}
