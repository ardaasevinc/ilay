<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Hizmetleriniz hakkında nasıl bilgi alabilirim?',
                'answer' => '<p>Hizmetlerimiz hakkında detaylı bilgi almak için <strong>iletişim formumuzu</strong> kullanabilir, telefon ile arayabilir veya e-posta gönderebilirsiniz. Uzman ekibimiz size en kısa sürede dönerek tüm sorularınızı yanıtlayacaktır.</p><p>Ayrıca web sitemizin <em>hizmetler</em> bölümünde her bir hizmetimiz hakkında detaylı bilgiler bulabilirsiniz.</p>',
                'sort_order' => 1,
                'is_active' => true,
                'published_at' => now(),
            ],
            [
                'question' => 'Proje süreci nasıl işler?',
                'answer' => '<p>Proje sürecimiz <strong>4 temel aşamadan</strong> oluşur:</p><ol><li><strong>Keşif ve Analiz:</strong> İhtiyaçlarınızı analiz ederiz</li><li><strong>Strateji Geliştirme:</strong> Size özel çözümler tasarlarız</li><li><strong>Uygulama:</strong> Projeyi hayata geçiririz</li><li><strong>İzleme ve Optimizasyon:</strong> Sonuçları takip ederiz</li></ol><p>Her aşamada size düzenli bilgilendirme yaparız ve şeffaf bir süreç yürütürüz.</p>',
                'sort_order' => 2,
                'is_active' => true,
                'published_at' => now(),
            ],
            [
                'question' => 'Fiyat teklifini nasıl alabilirim?',
                'answer' => '<p>Fiyat teklifi almak için:</p><ul><li>Web sitemizden <strong>teklif formumuzu</strong> doldurabilirsiniz</li><li>Doğrudan telefon ile arayabilirsiniz</li><li>E-posta gönderebilirsiniz</li><li>Ofisimize gelerek görüşme yapabilirsiniz</li></ul><p>Proje detaylarınızı paylaştıktan sonra <em>24 saat içinde</em> size özel teklif hazırlayıp sunarız.</p>',
                'sort_order' => 3,
                'is_active' => true,
                'published_at' => now(),
            ]
        ];

        foreach ($faqs as $faqData) {
            $faqData['slug'] = Str::slug($faqData['question']);
            Faq::create($faqData);
        }
    }
}
