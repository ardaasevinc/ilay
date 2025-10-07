<div>
    <x-filament-panels::page>
        <div class="grid gap-y-8">
            <x-filament::section>
                <x-slot name="heading">
                    Yeni Görseller Yükle
                </x-slot>

                <x-slot name="description">
                    Referans için birden fazla görsel yükleyebilirsiniz. Yüklenen görseller otomatik olarak kaydedilir.
                </x-slot>

                {{ $this->form }}
            </x-filament::section>

            <x-filament::section>
                <x-slot name="heading">
                    Mevcut Görseller
                </x-slot>

                <x-slot name="description">
                    Yüklü görselleri yönetebilir, sıralayabilir veya silebilirsiniz.
                </x-slot>

                {{ $this->table }}
            </x-filament::section>
        </div>
    </x-filament-panels::page>
</div>
