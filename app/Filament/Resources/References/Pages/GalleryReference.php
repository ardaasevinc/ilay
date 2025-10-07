<?php

namespace App\Filament\Resources\References\Pages;

use App\Filament\Resources\References\ReferenceResource;
use App\Models\Reference;
use App\Models\ReferenceGallery;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page as ResourcePage;
use Filament\Schemas\Schema;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class GalleryReference extends ResourcePage implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static string $resource = ReferenceResource::class;

    protected string $view = 'filament.resources.references.gallery-reference';

    public ?Reference $record = null;
    public ?array $data = [];

    public function mount(Reference $record): void
    {
        $this->record = $record;
        $this->form->fill();

        // Referans için klasör oluştur
        $referenceDirectory = "references/galleries/{$record->getKey()}";
        if (!Storage::disk('uploads')->exists($referenceDirectory)) {
            Storage::disk('uploads')->makeDirectory($referenceDirectory);
        }
    }

    public function getTitle(): string
    {
        return 'Galeri Yönetimi: ' . ($this->record?->title ?? '');
    }

    public function form(Schema $schema): Schema
    {
        $referenceId = $this->record?->getKey();

        return $schema
            ->statePath('data')
            ->schema([
                FileUpload::make('images')
                    ->label('Görseller')
                    ->multiple()
                    ->disk('uploads')
                    ->directory("references/galleries/{$referenceId}")
                    ->acceptedFileTypes(['image/*'])
                    ->image()
                    ->reorderable()
                    ->preserveFilenames(false)
                    ->panelLayout('grid')
                    ->maxFiles(20)
                    ->columnSpanFull()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (!empty($state) && $this->record) {
                            $this->autoSaveImages($state);
                            $set('images', []);
                        }
                    })
                    ->afterStateHydrated(fn(callable $set) => $set('images', [])),
            ]);
    }

    public function autoSaveImages($images): void
    {
        if (!empty($images) && $this->record) {
            $referenceId = $this->record->getKey();

            foreach ($images as $image) {
                if ($image instanceof TemporaryUploadedFile) {
                    $originalName = $image->getClientOriginalName();
                    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                    $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);

                    $timestamp = time() . rand(100, 999);
                    $filename = "{$nameWithoutExt}_{$timestamp}.{$extension}";
                    $path = "references/galleries/{$referenceId}/{$filename}";

                    Storage::disk('uploads')->putFileAs(
                        "references/galleries/{$referenceId}",
                        $image,
                        $filename
                    );

                    // Sıra numarası belirle
                    $maxOrder = ReferenceGallery::where('reference_id', $referenceId)
                        ->max('order_number') ?? 0;

                    ReferenceGallery::create([
                        'reference_id' => $referenceId,
                        'img' => $path,
                        'order_number' => $maxOrder + 1,
                        'is_active' => true,
                    ]);
                }
            }

            Notification::make()
                ->title('Görseller başarıyla yüklendi')
                ->success()
                ->send();

            $this->dispatch('refreshTable');
        }
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ReferenceGallery::query()->where('reference_id', $this->record->getKey()))
            ->columns([
                ImageColumn::make('img')
                    ->label('Görsel')
                    ->disk('uploads')
                    ->size(80)
                    ->square(),

                TextColumn::make('order_number')
                    ->label('Sıra')
                    ->sortable()
                    ->alignCenter(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('created_at')
                    ->label('Yüklenme Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('order_number')
            ->reorderable('order_number')
            ->actions([
                Action::make('toggle_active')
                    ->label(fn(ReferenceGallery $record) => $record->is_active ? 'Pasif Yap' : 'Aktif Yap')
                    ->icon(fn(ReferenceGallery $record) => $record->is_active ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn(ReferenceGallery $record) => $record->is_active ? 'warning' : 'success')
                    ->iconButton()
                    ->tooltip(fn(ReferenceGallery $record) => $record->is_active ? 'Pasif Yap' : 'Aktif Yap')
                    ->action(function (ReferenceGallery $record) {
                        $record->update(['is_active' => !$record->is_active]);

                        Notification::make()
                            ->title('Durum güncellendi')
                            ->success()
                            ->send();
                    }),

                Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->iconButton()
                    ->tooltip('Sil')
                    ->requiresConfirmation()
                    ->action(function (ReferenceGallery $record) {
                        // Dosyayı sil
                        if ($record->img && Storage::disk('uploads')->exists($record->img)) {
                            Storage::disk('uploads')->delete($record->img);
                        }

                        $record->delete();

                        Notification::make()
                            ->title('Görsel silindi')
                            ->success()
                            ->send();
                    }),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Referanslara Dön')
                ->icon('heroicon-o-arrow-left')
                ->url(fn() => ReferenceResource::getUrl('index'))
                ->color('gray'),
        ];
    }
}
