<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageGallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Hakkımızda',
                'slug' => 'hakkimizda',
                'desc' => '<h2>Şirketimiz Hakkında</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p><h3>Misyonumuz</h3><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><h3>Vizyonumuz</h3><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                'seo_title' => 'Hakkımızda - Şirket Bilgileri',
                'seo_key' => 'hakkımızda, şirket, misyon, vizyon, bilgi',
                'seo_desc' => 'Şirketimiz hakkında detaylı bilgiler, misyonumuz ve vizyonumuz',
                'is_active' => true,
                'sort_order' => 1,
                'published_at' => now(),
            ],
            [
                'title' => 'Hizmetlerimiz',
                'slug' => 'hizmetlerimiz',
                'desc' => '<h2>Sunduğumuz Hizmetler</h2><p>Şirketimiz aşağıdaki alanlarda profesyonel hizmet vermektedir:</p><ul><li><strong>Web Tasarım:</strong> Modern ve kullanıcı dostu web siteleri</li><li><strong>Mobil Uygulama:</strong> iOS ve Android uygulamaları</li><li><strong>E-Ticaret:</strong> Online satış platformları</li><li><strong>SEO:</strong> Arama motoru optimizasyonu</li></ul><p>Tüm projelerimizde kalite ve müşteri memnuniyetini ön planda tutuyoruz.</p>',
                'seo_title' => 'Hizmetlerimiz - Web Tasarım ve Mobil Uygulama',
                'seo_key' => 'web tasarım, mobil uygulama, e-ticaret, seo, hizmetler',
                'seo_desc' => 'Web tasarım, mobil uygulama geliştirme ve dijital pazarlama hizmetlerimiz',
                'is_active' => true,
                'sort_order' => 2,
                'published_at' => now(),
            ],
            [
                'title' => 'İletişim',
                'slug' => 'iletisim',
                'desc' => '<h2>Bizimle İletişime Geçin</h2><p>Sorularınız ve projeleriniz için bizimle iletişime geçebilirsiniz.</p><h3>İletişim Bilgileri</h3><p><strong>Adres:</strong> Örnek Mahallesi, Örnek Sokak No:123, İstanbul</p><p><strong>Telefon:</strong> +90 212 123 45 67</p><p><strong>E-posta:</strong> info@ornek.com</p><h3>Çalışma Saatleri</h3><p><strong>Pazartesi - Cuma:</strong> 09:00 - 18:00</p><p><strong>Cumartesi:</strong> 09:00 - 14:00</p><p><strong>Pazar:</strong> Kapalı</p>',
                'seo_title' => 'İletişim - Bize Ulaşın',
                'seo_key' => 'iletişim, adres, telefon, email, bize ulaşın',
                'seo_desc' => 'İletişim bilgilerimiz, adres ve telefon numaramız',
                'is_active' => true,
                'sort_order' => 3,
                'published_at' => now(),
            ],
            [
                'title' => 'Gizlilik Politikası',
                'slug' => 'gizlilik-politikasi',
                'desc' => '<h2>Gizlilik Politikası</h2><p>Bu gizlilik politikası, web sitemizi ziyaret ettiğinizde toplanan bilgilerin nasıl kullanıldığını açıklar.</p><h3>Toplanan Bilgiler</h3><p>Web sitemizi ziyaret ettiğinizde aşağıdaki bilgiler toplanabilir:</p><ul><li>IP adresi</li><li>Tarayıcı bilgileri</li><li>Ziyaret edilen sayfalar</li><li>Ziyaret süresi</li></ul><h3>Bilgilerin Kullanımı</h3><p>Toplanan bilgiler sadece hizmet kalitemizi artırmak amacıyla kullanılır.</p>',
                'seo_title' => 'Gizlilik Politikası - Kişisel Verilerin Korunması',
                'seo_key' => 'gizlilik politikası, kişisel veriler, kvkk, veri koruma',
                'seo_desc' => 'Gizlilik politikamız ve kişisel verilerin korunması hakkında bilgiler',
                'is_active' => true,
                'sort_order' => 4,
                'published_at' => now(),
            ],
            [
                'title' => 'Taslak Sayfa',
                'slug' => 'taslak-sayfa',
                'desc' => '<h2>Bu Bir Taslak Sayfadır</h2><p>Bu sayfa henüz yayınlanmamıştır ve sadece yönetici panelinde görüntülenebilir.</p>',
                'seo_title' => 'Taslak Sayfa',
                'seo_key' => 'taslak, draft',
                'seo_desc' => 'Bu bir taslak sayfadır',
                'is_active' => false,
                'sort_order' => 5,
                'published_at' => now()->addDays(1),
            ],
        ];

        foreach ($pages as $pageData) {
            $page = Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );

            // Her sayfa için örnek galeri görsellerini ekle (sadece aktif sayfalar için)
            if ($page->is_active && in_array($page->slug, ['hakkimizda', 'hizmetlerimiz'])) {
                PageGallery::updateOrCreate([
                    'page_id' => $page->id,
                    'image' => 'pages/sample-image-1.jpg',
                    'sort_order' => 1,
                    'is_active' => true,
                ]);

                PageGallery::updateOrCreate([
                    'page_id' => $page->id,
                    'image' => 'pages/sample-image-2.jpg',
                    'sort_order' => 2,
                    'is_active' => true,
                ]);
            }
        }

        $this->command->info('5 sayfa ve örnek galeri görselleri başarıyla oluşturuldu.');
    }
}
