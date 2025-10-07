<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicesData = [
            [
                'title' => 'Stratejik Danışmanlık',
                'desc' => 'Marka stratejisi, pazar araştırması ve iletişim stratejileri konularında kapsamlı danışmanlık hizmetleri sunuyoruz.',
                'services' => [
                    'Veri Analizi',
                    'Pazar Araştırması',
                    'İletişim Stratejisi',
                    'Marka Konumlandırma',
                    'Rekabet Analizi',
                    'Tüketici İçgörüsü',
                    'Trend ve İçerik Analizi',
                    'Marka Mimari ve Yeniden Konumlandırma',
                    'Destinasyon Pazarlama',
                    'Siyasal İletişim',
                    'Seçim Kampanyası',
                    'Etkinlik & Organizasyon',
                    'PR Projeleri',
                    '360° Entegre Kampanya Planlama',
                ]
            ],
            [
                'title' => 'Tasarım ve Reklam İletişimi',
                'desc' => 'Yaratıcı tasarım çözümleri ve etkili reklam iletişimi ile markanızı öne çıkarıyoruz.',
                'services' => [
                    'İletişim Konsepti Geliştirme',
                    'Kurum / Marka / Ürün Kimliği',
                    'Logo ve Kurumsal Kimlik Tasarımı',
                    'Reklam Kampanyası Tasarımı',
                    'Basılı & Dijital İletişim Tasarımı',
                    'Süreli Yayın Tasarımı (dergi, katalog, vb.)',
                    'Etkinlik / Lansman Tasarımı',
                    'Mimari Tasarım',
                    'Fuar & Festival Tasarımları',
                    'UI/UX & Web Arayüz Tasarımı',
                ]
            ],
            [
                'title' => 'Medya Prodüksiyonu',
                'desc' => 'Profesyonel video, fotoğraf ve animasyon prodüksiyonu ile içeriklerinizi hayata geçiriyoruz.',
                'services' => [
                    'Senaryo Yazımı',
                    'Film Prodüksiyonu',
                    'Post Prodüksiyon',
                    'Fotoğraf Prodüksiyonu',
                    '2D / 3D Animasyon',
                    'Motion Graphics',
                    'Reels / TikTok / Shorts İçerik Prodüksiyonu',
                    'Ürün / Lansman Çekimleri',
                ]
            ],
            [
                'title' => 'Dijital Pazarlama ve Sosyal Medya Yönetimi',
                'desc' => 'Dijital dünyada markanızın varlığını güçlendiren sosyal medya yönetimi ve pazarlama stratejileri.',
                'services' => [
                    'Sosyal Medya Yönetimi',
                    'İçerik Takvimi ve Üretimi',
                    'Sosyal Medya Kampanyaları',
                    'Influencer İşbirlikleri',
                    'Topluluk Yönetimi',
                    'Google Analytics Danışmanlığı',
                    'SEO / Arama Motoru Optimizasyonu',
                    'Mobil Pazarlama',
                    'Google Reklamları',
                ]
            ],
        ];

        foreach ($servicesData as $categoryIndex => $categoryData) {
            $categoryTitle = $categoryData['title'];
            $services = $categoryData['services'];

            $category = ServiceCategory::create([
                'title' => $categoryTitle,
                'slug' => Str::slug($categoryTitle),
                'desc' => $categoryData['desc'],
                'seo_title' => $categoryTitle,
                'seo_desc' => $categoryTitle . ' alanında profesyonel destek alın.',
                'seo_key' => Str::slug($categoryTitle) . ', hizmet, profesyonel',
                'img' => 'site/no-image.svg',
                'is_active' => true,
                'sort_order' => $categoryIndex + 1,
                'published_at' => now(),
            ]);

            foreach ($services as $index => $serviceTitle) {
                Service::create([
                    'service_category_id' => $category->id,
                    'sort_order' => $index + 1,
                    'img' => 'site/no-image.svg',
                    'title' => $serviceTitle,
                    'slug' => Str::slug($serviceTitle),
                    'desc' => match ($serviceTitle) {
                        // Stratejik Danışmanlık
                        'Veri Analizi' => 'Veri analizi ile iş hedeflerinize uygun içgörüler üretir, performansı artıran veri odaklı kararlar almanızı sağlarız.',
                        'Pazar Araştırması' => 'Pazar araştırmasıyla hedef kitlenizi, rakiplerinizi ve fırsat alanlarını netleştirir; büyüme stratejinizi veriye dayalı kurgularız.',
                        'İletişim Stratejisi' => 'İletişim stratejisi ile doğru mesajı doğru zamanda doğru kanala taşır, marka bilinirliği ve etkileşimi güçlendiririz.',
                        'Marka Konumlandırma' => 'Marka konumlandırma ile farklılaşmanızı netleştirip algıyı yönetir, hedef kitlede kalıcı bir iz bırakırız.',
                        'Rekabet Analizi' => 'Rekabet analizi ile rakiplerin stratejilerini çözümler, avantaj noktalarınızı belirleyip aksiyon planları üretiriz.',
                        'Tüketici İçgörüsü' => 'Tüketici içgörüsü çalışmalarıyla ihtiyaç ve motivasyonları keşfeder, dönüşüm odaklı stratejiler geliştiririz.',
                        'Trend ve İçerik Analizi' => 'Trend ve içerik analizi ile gündemi yakalar, yüksek performanslı içerik başlıkları ve formatları öneririz.',
                        'Marka Mimari ve Yeniden Konumlandırma' => 'Marka mimarisi ve yeniden konumlandırma ile portföyünüzü sadeleştirir, marka değerini artırırız.',
                        'Destinasyon Pazarlama' => 'Destinasyon pazarlama ile destinasyonunuzu özgün hikâyeler ve deneyim tasarımlarıyla öne çıkarırız.',
                        'Siyasal İletişim' => 'Siyasal iletişimde strateji, mesaj ve mecra bütünlüğü kurarak kamuoyu desteğini artırırız.',
                        'Seçim Kampanyası' => 'Seçim kampanyalarında hedef kitle analizleri, mesaj mimarisi ve saha-dijital entegrasyonuyla başarıyı optimize ederiz.',
                        'Etkinlik & Organizasyon' => 'Etkinlik ve organizasyonlarda uçtan uca planlama ile marka deneyimini güçlendirir, ölçülebilir sonuçlar üretiriz.',
                        'PR Projeleri' => 'PR projeleri ile itibar yönetimi ve görünürlük sağlar; medya ve paydaş iletişimini stratejik kurgularız.',
                        '360° Entegre Kampanya Planlama' => '360° entegre kampanyalarla tüm temas noktalarında tutarlılık sağlar, bütçenizi verimli kullanırız.',

                        // Tasarım ve Reklam İletişimi
                        'İletişim Konsepti Geliştirme' => 'İletişim konsepti ile marka vaadinizi yaratıcı bir çatı altında toplar, tutarlı bir dil oluştururuz.',
                        'Kurum / Marka / Ürün Kimliği' => 'Kurumsal kimlik çalışmalarıyla markanızın görsel/işitsel kimliğini güçlendirir, algıyı profesyonelce konumlandırırız.',
                        'Logo ve Kurumsal Kimlik Tasarımı' => 'Logo ve kurumsal kimlik tasarımıyla akılda kalıcı, ölçeklenebilir ve özgün bir marka imajı oluştururuz.',
                        'Reklam Kampanyası Tasarımı' => 'Reklam kampanyası tasarımıyla hedef odaklı, yüksek etkileşimli ve ölçümlenebilir yaratıcı fikirler üretiriz.',
                        'Basılı & Dijital İletişim Tasarımı' => 'Basılı ve dijital tasarımlarla her mecrada tutarlı, dikkat çekici ve markaya uygun deneyimler sunarız.',
                        'Süreli Yayın Tasarımı (dergi, katalog, vb.)' => 'Dergi ve katalog tasarımlarında yaratıcı mizanpaj ve tipografiyle okunabilirliği ve etkiyi artırırız.',
                        'Etkinlik / Lansman Tasarımı' => 'Etkinlik ve lansman tasarımlarıyla mekân, sahne ve deneyimi bütüncül kurgular, hatırlanırlık sağlarız.',
                        'Mimari Tasarım' => 'Mimari tasarım ile estetik ve fonksiyonel mekânlar kurgular, marka kimliğini fiziksel deneyime taşırız.',
                        'Fuar & Festival Tasarımları' => 'Fuar ve festival tasarımlarıyla dikkat çeken stant ve deneyim alanları oluştururuz.',
                        'UI/UX & Web Arayüz Tasarımı' => 'UI/UX ve web arayüz tasarımında kullanıcı odaklı, hızlı ve erişilebilir deneyimler tasarlarız.',

                        // Medya Prodüksiyonu
                        'Senaryo Yazımı' => 'Senaryo yazımıyla hedef kitleye uygun, duygusal bağ kuran yaratıcı hikâyeler geliştiririz.',
                        'Film Prodüksiyonu' => 'Film prodüksiyonunda planlama, çekim ve post süreçlerini profesyonelce yönetir, kaliteli içerik üretiriz.',
                        'Post Prodüksiyon' => 'Post prodüksiyon ile kurgu, renk ve ses tasarımı yaparak çekimlerinizi etkili içeriklere dönüştürürüz.',
                        'Fotoğraf Prodüksiyonu' => 'Fotoğraf prodüksiyonunda marka estetiğine uygun, yüksek kaliteli görseller üretiriz.',
                        '2D / 3D Animasyon' => '2D/3D animasyonla karmaşık mesajları anlaşılır, akılda kalıcı görsel anlatılara dönüştürürüz.',
                        'Motion Graphics' => 'Motion graphics ile dijital mecralarda dikkat çeken dinamik içerikler tasarlarız.',
                        'Reels / TikTok / Shorts İçerik Prodüksiyonu' => 'Kısa video prodüksiyonlarıyla sosyal medyada erişimi ve etkileşimi artıran içerikler üretiriz.',
                        'Ürün / Lansman Çekimleri' => 'Ürün ve lansman çekimlerinde satışa ve farkındalığa odaklı profesyonel görsel içerikler hazırlarız.',

                        // Dijital Pazarlama ve Sosyal Medya Yönetimi
                        'Sosyal Medya Yönetimi' => 'Sosyal medya yönetimiyle içerik, topluluk ve performansı bütünleşik ele alır; sürdürülebilir büyüme sağlarız.',
                        'İçerik Takvimi ve Üretimi' => 'İçerik takvimi ve üretimiyle düzenli, stratejik ve yüksek etkileşimli içerikler planlarız.',
                        'Sosyal Medya Kampanyaları' => 'Sosyal medya kampanyalarında hedef, mesaj ve bütçeyi optimize ederek sonuç odaklı performans elde ederiz.',
                        'Influencer İşbirlikleri' => 'Influencer işbirlikleriyle güven ve erişimi artırır, doğru kitlelerle organik bağ kurarız.',
                        'Topluluk Yönetimi' => 'Topluluk yönetimiyle takipçi ilişkilerini güçlendirir, sadakat ve etkileşimi artırırız.',
                        'Google Analytics Danışmanlığı' => 'Google Analytics danışmanlığıyla veri analizi yapar, KPI’lara göre optimize stratejiler geliştiririz.',
                        'SEO / Arama Motoru Optimizasyonu' => 'SEO ile organik görünürlüğü artırır, hedef anahtar kelimelerde üst sıralara çıkmanızı sağlarız.',
                        'Mobil Pazarlama' => 'Mobil pazarlama ile uygulama ve mobil webde büyümeyi destekleyen performans stratejileri uygularız.',
                        'Google Reklamları' => 'Google Ads kampanyalarını kurgulayıp optimize eder, dönüşüm ve ROAS’ı maksimize ederiz.',

                        default => $serviceTitle . ' hizmetinde strateji, uygulama ve ölçümlemeyi bütünleşik sunar; iş hedeflerinize doğrudan etki ederiz.',
                    },
                    'seo_title' => $serviceTitle . ' - ' . $categoryTitle,
                    'seo_key' => Str::slug($serviceTitle) . ', ' . Str::slug($categoryTitle) . ', hizmet, profesyonel',
                    'seo_desc' => $serviceTitle . ' hizmeti ile ' . $categoryTitle . ' alanında profesyonel destek alın.',
                    'is_active' => true,
                    'is_home' => false,
                    'published_at' => now(),
                ]);
            }
        }
    }
}
