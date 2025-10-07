<?php

namespace App\Filament\Resources\Services\Service;

use App\Filament\Resources\Services\ServiceResource;
use App\Models\Service;
use App\Models\ServiceGallery;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page as ResourcePage;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class GalleryPage extends ResourcePage implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static string $resource = ServiceResource::class;

    protected string $view = 'filament.resources.services.gallery-page';

    public ?Service $record = null;
    public ?array $data = [];

    public function mount(Service $record): void
    {
        $this->record = $record;
        $this->form->fill();

        // Hizmet için klasör oluştur
        $serviceDirectory = "service/galleries/{$record->getKey()}";
        if (!Storage::disk('uploads')->exists($serviceDirectory)) {
            Storage::disk('uploads')->makeDirectory($serviceDirectory);
        }

        // Galeri boşsa JavaScript alert göster
        $this->checkGalleryEmpty();
    }

    public function checkGalleryEmpty(): void
    {
        $galleryCount = ServiceGallery::where('service_id', $this->record->getKey())->count();

        if ($galleryCount === 0) {
            $this->dispatch('show-empty-gallery-alert', [
                'message' => 'Bu hizmet için henüz galeri görseli bulunmuyor. Lütfen görsel yükleyiniz.'
            ]);
        }
    }

    public function getTitle(): string
    {
        return 'Galeri Yönetimi: ' . ($this->record?->title ?? '');
    }

    public function form(Schema $schema): Schema
    {
        $serviceId = $this->record?->getKey();

        return $schema
            ->statePath('data')
            ->schema([
                FileUpload::make('images')
                    ->label('Görseller')
                    ->multiple()
                    ->disk('uploads')
                    ->directory("service/galleries/{$serviceId}")
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
            $serviceId = $this->record->getKey();

            foreach ($images as $image) {
                if ($image instanceof TemporaryUploadedFile) {
                    $originalName = $image->getClientOriginalName();
                    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                    $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);

                    $timestamp = time() . rand(100, 999);
                    $filename = "{$nameWithoutExt}_{$timestamp}.{$extension}";
                    $path = "service/galleries/{$serviceId}/{$filename}";

                    Storage::disk('uploads')->putFileAs(
                        "service/galleries/{$serviceId}",
                        $image,
                        $filename
                    );

                    $exists = ServiceGallery::where('service_id', $serviceId)
                        ->where('img', $path)
                        ->exists();

                    if (!$exists) {
                        ServiceGallery::create([
                            'service_id' => $serviceId,
                            'img' => $path,
                            'order_number' => 0,
                            'is_active' => true,
                        ]);
                    }
                }
            }

            Notification::make()
                ->title('Görsel otomatik yüklendi!')
                ->success()
                ->send();

            $this->form->fill([
                'images' => [],
            ]);

            $this->dispatch('refresh-gallery');
        }
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('order_number')
            ->query(ServiceGallery::query()->where('service_id', $this->record->getKey()))
            ->emptyStateHeading('Galeri Boş')
            ->emptyStateDescription('Bu hizmet için henüz galeri görseli yüklenmemiş.')
            ->emptyStateIcon('heroicon-o-photo')
            ->columns([
                ImageColumn::make('img')
                    ->label('Görsel')
                    ->disk('uploads')
                    ->height(80)
                    ->width(80)
                    ->square(),

                TextColumn::make('order_number')
                    ->label('Sıra')
                    ->sortable()
                    ->badge()
                    ->alignCenter(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter(),
            ])
            ->actions([
                Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->iconButton()
                    ->tooltip('Sil')
                    ->requiresConfirmation()
                    ->action(function (ServiceGallery $record) {
                        // Dosyayı sil
                        if (Storage::disk('uploads')->exists($record->img)) {
                            Storage::disk('uploads')->delete($record->img);
                        }

                        // Veritabanından sil
                        $record->delete();

                        Notification::make()
                            ->title('Görsel silindi!')
                            ->success()
                            ->send();

                        // Tabloyu yenile
                        $this->dispatch('refresh-gallery');
                        $this->resetTable();
                    }),
            ])
            ->defaultSort('order_number', 'asc')
            ->defaultPaginationPageOption(5)
            ->paginationPageOptions([5, 10, 25, 50, 100, 'all'])
            ->paginated(true);
    }

    public function deleteGalleryItem($recordId)
    {
        $record = ServiceGallery::find($recordId);
        if ($record) {
            if (Storage::disk('uploads')->exists($record->img)) {
                Storage::disk('uploads')->delete($record->img);
            }

            $record->delete();

            Notification::make()
                ->title('Görsel silindi!')
                ->success()
                ->send();

            $this->dispatch('refresh-gallery');
        }
    }
}
