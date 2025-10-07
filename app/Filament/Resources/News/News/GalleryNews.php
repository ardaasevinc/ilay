<?php

namespace App\Filament\Resources\News\News;

use App\Filament\Resources\News\NewsResource;
use App\Models\News;
use App\Models\NewsGallery;
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

class GalleryNews extends ResourcePage implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static string $resource = NewsResource::class;

    protected string $view = 'filament.resources.news.gallery-news';

    public ?News $record = null;
    public ?array $data = [];

    public function mount(News $record): void
    {
        $this->record = $record;
        $this->form->fill();

        // Haber için klasör oluştur
        $newsDirectory = "news/galleries/{$record->getKey()}";
        if (!Storage::disk('uploads')->exists($newsDirectory)) {
            Storage::disk('uploads')->makeDirectory($newsDirectory);
        }
    }

    public function getTitle(): string
    {
        return 'Galeri Yönetimi: ' . ($this->record?->title ?? '');
    }

    public function form(Schema $schema): Schema
    {
        $newsId = $this->record?->getKey();

        return $schema
            ->statePath('data')
            ->schema([
                FileUpload::make('images')
                    ->label('Görseller')
                    ->multiple()
                    ->disk('uploads')
                    ->directory("news/galleries/{$newsId}")
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
            $newsId = $this->record->getKey();

            foreach ($images as $image) {
                if ($image instanceof TemporaryUploadedFile) {
                    $originalName = $image->getClientOriginalName();
                    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                    $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);

                    $timestamp = time() . rand(100, 999);
                    $filename = "{$nameWithoutExt}_{$timestamp}.{$extension}";
                    $path = "news/galleries/{$newsId}/{$filename}";

                    Storage::disk('uploads')->putFileAs(
                        "news/galleries/{$newsId}",
                        $image,
                        $filename
                    );

                    $exists = NewsGallery::where('news_id', $newsId)
                        ->where('img', $path)
                        ->exists();

                    if (!$exists) {
                        NewsGallery::create([
                            'news_id' => $newsId,
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
            ->query(NewsGallery::query()->where('news_id', $this->record->getKey()))
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
                    ->action(function (NewsGallery $record) {
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
        $record = NewsGallery::find($recordId);
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
