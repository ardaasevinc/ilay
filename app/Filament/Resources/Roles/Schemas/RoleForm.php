<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Permission;

class RoleForm
{
    /**
     * Rol oluşturma ve düzenleme formunun şemasını tanımlar.
     * Filament v4 ile uyumludur.
     */
    public static function configure(Schema $schema): Schema
    {
        // v4 UYUMLU: $schema->components() metodu kullanılır
        return $schema->components([
            Section::make('Rol Temel Bilgileri')
                ->description('Rolün adını ve sistemdeki korumasını belirtin.')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label('Yetki Adı')
                        ->placeholder('Örn: Editör')
                        ->required()
                        ->unique(ignoreRecord: true) // Düzenleme sırasında kendi adını kontrol etmez
                        ->maxLength(255),

                    TextInput::make('guard_name')
                        ->label('Guard Adı')
                        ->default('web')
                        ->required()
                        ->maxLength(255),
                ])->columnSpan(2)
                ->columnSpanFull(),

            Section::make('İzinler')
                ->description('Bu role atanacak tüm izinleri seçin.')
                ->schema(function () {
                    // Modellere göre izinleri grupla
                    $permissionsByModel = self::getPermissionsByModel();

                    $formComponents = [];

                    // Her model için ayrı bir CheckboxList oluştur
                    foreach ($permissionsByModel as $modelName => $permissions) {
                        // Model adından temiz bir ID oluştur (emoji ve özel karakterleri kaldır)
                        $modelKey = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower(trim($modelName)));

                        $formComponents[] = Section::make($modelName)
                            ->schema([
                                CheckboxList::make("permissions_{$modelKey}")
                                    ->label(null)
                                    ->hiddenLabel() // Başlığı Section'da gösterdiğimiz için burada göstermeye gerek yok
                                    ->options($permissions)
                                    ->bulkToggleable()
                                    ->columns(2) // Seçenekleri 3 sütunda göster
                                    ->dehydrated(true)
                                    ->gridDirection('row')
                                    ->extraAttributes([
                                        'class' => 'border border-gray-200 rounded-lg p-4 shadow-sm',
                                    ])
                                    ->afterStateHydrated(function ($component, $state) use ($modelKey, $permissions) {
                                        $record = $component->getRecord();
                                        if ($record && $record->permissions) {
                                            $recordPermissions = $record->permissions->pluck('name')->toArray();

                                            // Bu modele ait izinleri filtrele (izin adları bu modelin seçenekleri içinde olmalı)
                                            $modelPermissions = array_intersect($recordPermissions, array_keys($permissions));

                                            $component->state($modelPermissions);
                                        }
                                    })
                            ])
                            ->collapsible() // Daraltılabilir yapma
                            ->compact(); // Biraz daha kompakt bir görünüm
                    }

                    // Formları doğrudan dizi olarak döndür, ancak yan yana göstermek için grid oluştur
                    return $formComponents;
                })
                ->columns(3) // Grupları yan yana göster - her satırda 2 grup
                ->columnSpan(3)
                ->columnSpanFull()
                // Form kaydedilirken tüm izinleri tek seferde kaydet
                ->saveRelationshipsUsing(function ($component, $state) {
                    // State içindeki permissions_ ile başlayan tüm alanları al
                    $allPermissions = collect($state)
                        ->filter(fn($value, $key) => str_starts_with($key, 'permissions_') && !empty($value))
                        ->flatten()
                        ->unique()
                        ->toArray();

                    // Tüm izinleri bir kerede senkronize et
                    $component->getRecord()->permissions()->sync(
                        $allPermissions ? Permission::whereIn('name', $allPermissions)->pluck('id') : []
                    );
                }),
        ]);
    }

    /**
     * İzinleri model adlarına göre gruplandır
     * Her model için ayrı bir CheckboxList oluşturmak üzere kullanılır
     */
    protected static function getPermissionsByModel(): array
    {
        // Modül adlarını daha okunabilir hale getirmek için bir harita
        $modelNames = [
            'dashboard'         => 'Kontrol Paneli',
            'pages'             => 'Sayfalar',
            'references'        => 'Referanslar',
            'roles'             => 'Roller & Yetkiler',
            'users'             => 'Kullanıcılar',
            'news'              => 'Haberler',
            'news_categories'   => 'Haber Kategorileri',
            'services'          => 'Hizmetler',
            'service_categories' => 'Hizmet Kategorileri',
            'service_galleries' => 'Hizmet Galerileri',
            'settings'          => 'Ayarlar',
            'contacts'          => 'İletişim Formları',
            'brand_briefs'      => 'Marka Analizi',
            'email_logs'        => 'E-posta Logları',
            'subscription'      => 'Abonelikler',
            'faq'              => 'Sık Sorulanlar',
            'sliders'          => 'Sliderlar',
        ];

        // Eylem adlarını daha okunabilir hale getirmek için bir harita
        $actionTitles = [
            'index'        => 'Listele',
            'create'       => 'Oluştur',
            'view'         => 'Görüntüle',
            'viewAny'      => 'Tümünü Görüntüle',
            'update'       => 'Düzenle',
            'delete'       => 'Sil',
            'restore'      => 'Geri Yükle',
            'forceDelete'  => 'Kalıcı Sil',
            'impersonate'  => 'Kimliğe Bürün',
            'export'       => 'Dışa Aktar',
            'import'       => 'İçe Aktar',
            'edit'         => 'Düzenle',
            'access'       => 'Erişim',
            'excel'        => 'Excel Dışa Aktar',
            'pdf'          => 'PDF Dışa Aktar',
        ];

        // İzinleri veritabanından alıp isme göre sırala
        $permissions = Permission::query()->orderBy('name')->get();

        // Her model için ayrı bir dizi oluştur
        $permissionsByModel = [];

        foreach ($permissions as $permission) {
            // İzin adını '.' karakterinden bölerek modül ve eylemi ayır
            $parts = explode('.', $permission->name);
            $module = $parts[0];

            // Eğer 3 parça varsa (örn: subscription.export.excel), ikinci ve üçüncü parçayı birleştir
            if (count($parts) >= 3) {
                $action = implode('.', array_slice($parts, 1));
            } else {
                $action = $parts[1] ?? null;
            }

            // Modül adını daha okunabilir hale getir
            $modelTitle = $modelNames[$module] ?? ucfirst(str_replace('_', ' ', $module));

            // Özel export action'ları için
            if (str_contains($action, 'export.excel')) {
                $actionLabel = 'Excel Dışa Aktar';
            } elseif (str_contains($action, 'export.pdf')) {
                $actionLabel = 'PDF Dışa Aktar';
            } else {
                // Eylemin okunabilir adını al
                $actionLabel = $actionTitles[$action] ?? ucfirst($action ?: $permission->name);
            }

            // İzni modele göre grupla
            $permissionsByModel[$modelTitle][$permission->name] = $actionLabel;
        }

        // Modelleri alfabetik olarak sırala
        ksort($permissionsByModel);

        return $permissionsByModel;
    }
}
