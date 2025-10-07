<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        // Kategoriler oluştur
        $categories = [
            [
                'title' => 'Genel Haberler',
                'slug' => 'genel-haberler',
                'seo_title' => 'Genel Haberler | CMS',
                'seo_desc' => 'Güncel genel haberler ve gelişmeler',
                'is_active' => true,
            ],
            [
                'title' => 'Teknoloji',
                'slug' => 'teknoloji',
                'seo_title' => 'Teknoloji Haberleri | CMS',
                'seo_desc' => 'Son teknoloji haberleri ve yenilikler',
                'is_active' => true,
            ],
            [
                'title' => 'Spor',
                'slug' => 'spor',
                'seo_title' => 'Spor Haberleri | CMS',
                'seo_desc' => 'Güncel spor haberleri ve sonuçları',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            NewsCategory::create($category);
        }

        // Haberler oluştur
        $news = [
            [
                'news_category_id' => 1,
                'title' => 'Lorem Ipsum Haber Başlığı',
                'slug' => 'lorem-ipsum-haber-basligi',
                'desc' => '<p>Bu bir örnek haber içeriğidir. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>',
                'seo_title' => 'Lorem Ipsum Haber | CMS',
                'seo_desc' => 'Bu bir örnek haber açıklamasıdır',
                'is_active' => true,
                'is_home' => true,
            ],
            [
                'news_category_id' => 2,
                'title' => 'Teknoloji Dünyasında Yenilikler',
                'slug' => 'teknoloji-dunyasinda-yenilikler',
                'desc' => '<p>Teknoloji dünyasında son gelişmeler ve yenilikler hakkında detaylı bilgiler.</p><p>Yapay zeka, blockchain ve IoT teknolojilerinin gelişimi devam ediyor.</p>',
                'seo_title' => 'Teknoloji Yenilikleri | CMS',
                'seo_desc' => 'Teknoloji dünyasında son gelişmeler',
                'is_active' => true,
                'is_home' => false,
            ],
            [
                'news_category_id' => 3,
                'title' => 'Spor Dünyasından Haberler',
                'slug' => 'spor-dunyasindan-haberler',
                'desc' => '<p>Spor dünyasından güncel haberler ve maç sonuçları.</p><p>Futbol, basketbol ve diğer spor dallarından önemli gelişmeler.</p>',
                'seo_title' => 'Spor Haberleri | CMS',
                'seo_desc' => 'Güncel spor haberleri ve sonuçları',
                'is_active' => true,
                'is_home' => true,
            ],
        ];

        foreach ($news as $item) {
            News::create($item);
        }
    }
}
