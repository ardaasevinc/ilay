<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use App\Models\Page;
use App\Models\PageGallery;
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

    protected static string $resource = PageResource::class;

    protected string $view = 'filament.resources.pages.gallery-page';

    public ?Page $record = null;
    public ?array $data = [];

    public function mount(Page $record): void
    {
        $this->record = $record;
        $this->form->fill();

        // Sayfa için klasör oluştur
        $pageDirectory = "pages/galleries/{$record->getKey()}";
        if (!Storage::disk('uploads')->exists($pageDirectory)) {
            Storage::disk('uploads')->makeDirectory($pageDirectory);
        }
    }

    public function getTitle(): string
    {
        return 'Galeri Yönetimi: ' . ($this->record?->title ?? '');
    }

    public function form(Schema $schema): Schema
    {
        $pageId = $this->record?->getKey();

        return $schema
            ->statePath('data')
            ->schema([
                FileUpload::make('images')
                    ->label('Görseller')
                    ->multiple()
                    ->disk('uploads')
                    ->directory("pages/galleries/{$pageId}")
                    ->acceptedFileTypes(['image/*'])
                    ->image()
                    ->reorderable()
                    ->preserveFilenames(false) // Timestamp ekleyeceğiz
                    ->panelLayout('grid')
                    ->maxFiles(20)
                    ->columnSpanFull()
                    ->live() // Anlık güncellemeler için
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (!empty($state) && $this->record) {
                            $this->autoSaveImages($state);

                            // Yükleme tamamlandıktan sonra inputu sıfırla
                            $set('images', []);
                        }
                    })
                    ->afterStateHydrated(fn(callable $set) => $set('images', [])),
            ]);
    }

    public function autoSaveImages($images): void
    {
        if (!empty($images) && $this->record) {
            $pageId = $this->record->getKey();

            foreach ($images as $image) {
                // Sadece yeni dosyaları işle (string path olanları değil)
                if ($image instanceof TemporaryUploadedFile) {
                    $originalName = $image->getClientOriginalName();
                    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                    $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);

                    // Timestamp ile unique dosya adı oluştur
                    $timestamp = time() . rand(100, 999); // Daha unique için random ekliyoruz
                    $filename = "{$nameWithoutExt}_{$timestamp}.{$extension}";
                    $path = "pages/galleries/{$pageId}/{$filename}";

                    // Dosyayı kaydet
                    Storage::disk('uploads')->putFileAs(
                        "pages/galleries/{$pageId}",
                        $image,
                        $filename
                    );

                    // Veritabanına kaydet
                    $exists = PageGallery::where('page_id', $pageId)
                        ->where('image', $path)
                        ->exists();

                    if (!$exists) {
                        PageGallery::create([
                            'page_id' => $pageId,
                            'image' => $path,
                            'sort_order' => 0,
                            'is_active' => true,
                        ]);
                    }
                }
            }

            // Başarı bildirimi
            Notification::make()
                ->title('Görsel otomatik yüklendi!')
                ->success()
                ->send();

            $this->form->fill([
                'images' => [],
            ]);
            // Tabloyu yenile
            $this->dispatch('refresh-gallery');
        }
    }

    public function processUpload(): void
    {
        $formData = $this->form->getState();
        $images = $formData['images'] ?? [];

        if (!empty($images) && $this->record) {
            $pageId = $this->record->getKey();
            $savedFiles = [];

            foreach ($images as $image) {
                if ($image instanceof TemporaryUploadedFile) {
                    $originalName = $image->getClientOriginalName();
                    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                    $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);

                    // Timestamp ile unique dosya adı oluştur
                    $timestamp = time();
                    $filename = "{$nameWithoutExt}_{$timestamp}.{$extension}";
                    $path = "pages/galleries/{$pageId}/{$filename}";

                    Storage::disk('uploads')->putFileAs(
                        "pages/galleries/{$pageId}",
                        $image,
                        $filename
                    );

                    $savedFiles[] = $path;
                } else {
                    $savedFiles[] = $image;
                }
            }
            foreach ($savedFiles as $filePath) {
                $exists = PageGallery::where('page_id', $pageId)
                    ->where('image', $filePath)
                    ->exists();

                if (!$exists) {
                    PageGallery::create([
                        'page_id' => $pageId,
                        'image' => $filePath,
                        'sort_order' => 0,
                        'is_active' => true,
                    ]);
                }
            }

            $this->form->fill(['images' => []]);

            Notification::make()
                ->title('Başarılı!')
                ->body(count($savedFiles) . ' görsel kaydedildi.')
                ->success()
                ->send();

            $this->dispatch('refresh-gallery');
        } else {
            Notification::make()
                ->title('Uyarı!')
                ->body('Lütfen en az bir görsel seçin.')
                ->warning()
                ->send();
        }
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->query(PageGallery::query()->where('page_id', $this->record->getKey()))
            ->columns([
                ImageColumn::make('image')
                    ->label('Görsel')
                    ->disk('uploads')
                    ->height(50)
                    ->width(50)
                    ->square(),
                TextColumn::make('sort_order')
                    ->label('Sıra')
                    ->sortable()
                    ->badge()
                    ->alignCenter(),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
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
                    ->action(function (PageGallery $record) {
                        // Dosyayı sil
                        if (Storage::disk('uploads')->exists($record->image)) {
                            Storage::disk('uploads')->delete($record->image);
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
            ->defaultSort('sort_order', 'asc')
            ->defaultPaginationPageOption(5)
            ->paginationPageOptions([5, 10, 25, 50, 100, 'all'])
            ->paginated(true);
    }

    public function deleteGalleryItem($recordId)
    {
        $record = PageGallery::find($recordId);
        if ($record) {
            // Dosyayı sil
            if (Storage::disk('uploads')->exists($record->image)) {
                Storage::disk('uploads')->delete($record->image);
            }

            // Veritabanından sil
            $record->delete();

            Notification::make()
                ->title('Görsel silindi!')
                ->success()
                ->send();

            $this->dispatch('refresh-gallery');
        }
    }
}
