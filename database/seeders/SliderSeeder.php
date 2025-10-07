<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'img' => 'sliders/slider1.jpg',
                'title' => 'Web Tasarım Hizmetlerimiz',
                'description' => 'Modern ve kullanıcı dostu web siteleri tasarlıyor, markanızı dijital dünyada öne çıkarıyoruz.',
                'type_id' => 1,
                'type_content' => 'https://example.com/web-tasarim',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'img' => 'sliders/slider2.jpg',
                'title' => 'E-Ticaret Çözümleri',
                'description' => 'Satış odaklı e-ticaret platformları ile işletmenizi online dünyaya taşıyın.',
                'type_id' => 1,
                'type_content' => 'https://example.com/e-ticaret',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'img' => 'sliders/slider3.jpg',
                'title' => 'Dijital Pazarlama',
                'description' => 'SEO, sosyal medya ve dijital reklam stratejileri ile hedef kitlenize ulaşın.',
                'type_id' => 1,
                'type_content' => 'https://example.com/dijital-pazarlama',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
