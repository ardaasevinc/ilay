<x-filament-panels::page x-data="{}" x-on:refresh-gallery.window="$wire.$refresh()"
    x-on:refreshGallery.window="$wire.$refresh()">
    <div class="space-y-6">
        <!-- Dosya Yükleme Formu -->
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-content px-6 py-4 mb-5">
                <form wire:submit.prevent="saveGallery">
                    {{ $this->form }}

                </form>
            </div>
        </div>

        <!-- Galeri Tablosu -->
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-content">
                <div class="gallery-grid">
                    {{ $this->table }}
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
