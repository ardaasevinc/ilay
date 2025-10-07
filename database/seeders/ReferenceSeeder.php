<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Reference;
use App\Models\Service;

class ReferenceSeeder extends Seeder
{
    public function run(): void
    {
        $references = [
            // Tasarım
            [
                'title' => 'ATRUCKSYON Dergisi',
                'desc' => 'İsim, logo, kurumsal kimlik, dergi konsepti, sosyal medya ve web sitesi tasarımı.',
                'img' => 'references/atrucksyon.jpg',
                'url' => 'https://ilayajans.com/atrucksyon',
                'category' => 'tasarım',
                'services' => ['logo-ve-kurumsal-kimlik-tasarimi', 'reklam-kampanyasi-tasarimi', 'ui-ux-ve-web-arayuz-tasarimi'],
            ],
            [
                'title' => 'Colors of the World Fair',
                'desc' => 'Fuar alanı, konsept tasarımı, internet sitesi ve sosyal medya yönetimi.',
                'img' => 'references/colors-of-the-world.jpg',
                'url' => 'https://ilayajans.com/colors-of-the-world',
                'category' => 'tasarım',
                'services' => ['mimari-fuar-ve-festival-tasarimlari', 'ui-ux-ve-web-arayuz-tasarimi', 'sosyal-medya-yonetimi'],
            ],
            [
                'title' => 'Marmara Lastik',
                'desc' => 'Logo, kurumsal kimlik, tanıtım filmi, reklam kampanyası ve sosyal medya yönetimi.',
                'img' => 'references/marmara-lastik.jpg',
                'url' => 'https://ilayajans.com/marmara-lastik',
                'category' => 'tasarım',
                'services' => ['logo-ve-kurumsal-kimlik-tasarimi', 'film-ve-post-produskiyon', 'reklam-kampanyasi-tasarimi', 'sosyal-medya-yonetimi'],
            ],

            // Organizasyon
            [
                'title' => 'Akhisar Belediyesi',
                'desc' => 'Fotoğraf sergileri, festival kimliği, destinasyon pazarlama ve organizasyon yönetimi.',
                'img' => 'references/akhisar-belediyesi.jpg',
                'url' => 'https://ilayajans.com/akhisar-belediyesi',
                'category' => 'organizasyon',
                'services' => ['etkinlik-ve-lansman-organizasyonu', 'festival-ve-sergi-organizasyonu', 'destinasyon-pazarlama', 'fotoğraf-produskiyonu'],
            ],

            // Marka Oluşturma
            [
                'title' => 'Zeyo',
                'desc' => 'Logo, kurumsal kimlik, fotoğraf prodüksiyonu, ambalaj ve reklam filmi.',
                'img' => 'references/zeyo.jpg',
                'url' => 'https://ilayajans.com/zeyo',
                'category' => 'marka',
                'services' => ['logo-ve-kurumsal-kimlik-tasarimi', 'fotoğraf-produskiyonu', 'film-ve-post-produskiyon', 'ambalaj-tasarimi'],
            ],
            [
                'title' => 'Andino Gömlek',
                'desc' => 'Logo, kurumsal kimlik, ambalaj tasarımı, reklam kampanyası ve fotoğraf prodüksiyonu.',
                'img' => 'references/andino.jpg',
                'url' => 'https://ilayajans.com/andino',
                'category' => 'marka',
                'services' => ['logo-ve-kurumsal-kimlik-tasarimi', 'ambalaj-tasarimi', 'reklam-kampanyasi-tasarimi', 'fotoğraf-produskiyonu'],
            ],
            [
                'title' => 'Esin Uzer Güzellik Merkezi',
                'desc' => 'Logo, kurumsal kimlik, internet sitesi ve mimari tasarım.',
                'img' => 'references/esin-uzer.jpg',
                'url' => 'https://ilayajans.com/esin-uzer',
                'category' => 'marka',
                'services' => ['logo-ve-kurumsal-kimlik-tasarimi', 'ui-ux-ve-web-arayuz-tasarimi', 'mimari-fuar-ve-festival-tasarimlari'],
            ],

            // Destinasyon Pazarlama
            [
                'title' => 'Çatalca Belediyesi',
                'desc' => 'Kent kataloğu, kültür turizm haritası, promosyon tasarımı, reklam kampanyası ve stand tasarımı.',
                'img' => 'references/catalca-belediyesi.jpg',
                'url' => 'https://ilayajans.com/catalca-belediyesi',
                'category' => 'destinasyon',
                'services' => ['destinasyon-pazarlama', 'kent-kimligi-ve-marka-sehir-calismalari', 'reklam-kampanyasi-tasarimi', 'fotoğraf-produskiyonu'],
            ],
        ];

        foreach ($references as $ref) {
            $reference = Reference::create([
                'img' => $ref['img'],
                'title' => $ref['title'],
                'slug' => Str::slug($ref['title']),
                'desc' => $ref['desc'],
                'url' => $ref['url'],
                'seo_title' => $ref['title'] . ' | İlay Ajans',
                'seo_key' => Str::slug($ref['title'], ', '),
                'seo_desc' => $ref['desc'],
                'is_active' => true,
                'is_home' => false,
                'sort_order' => 1,
            ]);

            // Hizmetleri pivot tabloya bağla
            $serviceIds = Service::whereIn('slug', $ref['services'])->pluck('id')->toArray();

            if (!empty($serviceIds)) {
                $reference->services()->attach($serviceIds);
            }
        }
    }
}
