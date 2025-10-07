<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the table before seeding
        DB::table('settings')->truncate();

        // General site settings
        $this->createGeneralSettings();
        // Contact information settings
        $this->createContactSettings();
        // Social media settings
        $this->createSocialSettings();
        // SEO settings
        $this->createSeoSettings();
        // Appearance settings (logos, favicon, etc.)
        $this->createAppearanceSettings();
        // Mail settings
        $this->createMailSettings();
        // System settings (Redis, Cache, etc.)
        $this->createSystemSettings();
    }

    private function createGeneralSettings(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'name' => 'Site Adı',
                'value' => 'Kurumsal Web Sitesi',
                'type' => 'text',
                'group' => 'general',
                'is_public' => true,
                'order' => 1,
            ],
            [
                'key' => 'site_description',
                'name' => 'Site Açıklaması',
                'value' => 'Kurumsal ajansınız için modern ve profesyonel web sitesi.',
                'type' => 'textarea',
                'group' => 'general',
                'is_public' => true,
                'order' => 2,
            ],
            [
                'key' => 'site_active',
                'name' => 'Site Aktif',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'general',
                'is_public' => true,
                'order' => 3,
            ],
            [
                'key' => 'maintenance_mode',
                'name' => 'Bakım Modu',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'general',
                'is_public' => true,
                'order' => 4,
            ],
            [
                'key' => 'maintenance_message',
                'name' => 'Bakım Modu Mesajı',
                'value' => 'Sitemiz şu anda bakımdadır. Lütfen daha sonra tekrar ziyaret edin.',
                'type' => 'textarea',
                'group' => 'general',
                'is_public' => true,
                'order' => 5,
            ],
            [
                'key' => 'admin_title',
                'name' => 'Admin Panel Başlığı',
                'value' => 'Yönetim Paneli',
                'type' => 'text',
                'group' => 'general',
                'is_public' => false,
                'order' => 10,
            ],
        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }

    private function createContactSettings(): void
    {
        $settings = [
            [
                'key' => 'contact_email',
                'name' => 'İletişim E-posta Adresi',
                'value' => 'info@kurumsalajans.com',
                'type' => 'email',
                'group' => 'contact',
                'is_public' => true,
                'order' => 1,
            ],
            [
                'key' => 'contact_phone',
                'name' => 'İletişim Telefon Numarası',
                'value' => '+90 212 000 00 00',
                'type' => 'text',
                'group' => 'contact',
                'is_public' => true,
                'order' => 2,
            ],
            [
                'key' => 'contact_address',
                'name' => 'İletişim Adresi',
                'value' => 'İstanbul, Türkiye',
                'type' => 'textarea',
                'group' => 'contact',
                'is_public' => true,
                'order' => 3,
            ],
            [
                'key' => 'google_maps_embed',
                'name' => 'Google Harita Yerleştirme Kodu',
                'value' => '',
                'type' => 'textarea',
                'group' => 'contact',
                'is_public' => true,
                'order' => 4,
            ],
            [
                'key' => 'contact_form_recipients',
                'name' => 'İletişim Formu Alıcıları',
                'value' => 'info@kurumsalajans.com',
                'type' => 'text',
                'group' => 'contact',
                'is_public' => false,
                'order' => 5,
            ],
        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }

    private function createSocialSettings(): void
    {
        $settings = [
            [
                'key' => 'social_facebook',
                'name' => 'Facebook URL',
                'value' => 'https://facebook.com/',
                'type' => 'url',
                'group' => 'social',
                'is_public' => true,
                'order' => 1,
            ],
            [
                'key' => 'social_twitter',
                'name' => 'Twitter URL',
                'value' => 'https://twitter.com/',
                'type' => 'url',
                'group' => 'social',
                'is_public' => true,
                'order' => 2,
            ],
            [
                'key' => 'social_instagram',
                'name' => 'Instagram URL',
                'value' => 'https://instagram.com/',
                'type' => 'url',
                'group' => 'social',
                'is_public' => true,
                'order' => 3,
            ],
            [
                'key' => 'social_linkedin',
                'name' => 'LinkedIn URL',
                'value' => 'https://linkedin.com/company/',
                'type' => 'url',
                'group' => 'social',
                'is_public' => true,
                'order' => 4,
            ],
            [
                'key' => 'social_youtube',
                'name' => 'YouTube URL',
                'value' => 'https://youtube.com/',
                'type' => 'url',
                'group' => 'social',
                'is_public' => true,
                'order' => 5,
            ],
        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }

    private function createSeoSettings(): void
    {
        $settings = [
            [
                'key' => 'meta_title',
                'name' => 'Meta Başlığı',
                'value' => 'Kurumsal Web Sitesi',
                'type' => 'text',
                'group' => 'seo',
                'is_public' => true,
                'order' => 1,
            ],
            [
                'key' => 'meta_description',
                'name' => 'Meta Açıklaması',
                'value' => 'Kurumsal ajansınız için profesyonel web sitesi çözümleri.',
                'type' => 'textarea',
                'group' => 'seo',
                'is_public' => true,
                'order' => 2,
            ],
            [
                'key' => 'meta_keywords',
                'name' => 'Meta Anahtar Kelimeleri',
                'value' => 'kurumsal, ajans, web, yazılım, tasarım, hizmet',
                'type' => 'textarea',
                'group' => 'seo',
                'is_public' => true,
                'order' => 3,
            ],
            [
                'key' => 'google_analytics',
                'name' => 'Google Analytics Kodu',
                'value' => '',
                'type' => 'textarea',
                'group' => 'seo',
                'is_public' => true,
                'order' => 4,
            ],
            [
                'key' => 'google_tag_manager',
                'name' => 'Google Tag Manager Kodu',
                'value' => '',
                'type' => 'textarea',
                'group' => 'seo',
                'is_public' => true,
                'order' => 5,
            ],
            [
                'key' => 'google_site_verification',
                'name' => 'Google Site Doğrulama Kodu',
                'value' => '',
                'type' => 'text',
                'group' => 'seo',
                'is_public' => true,
                'order' => 6,
            ],
        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }

    private function createAppearanceSettings(): void
    {
        $settings = [
            [
                'key' => 'site_logo',
                'name' => 'Site Logosu',
                'value' => '',
                'type' => 'image',
                'group' => 'appearance',
                'is_public' => true,
                'order' => 1,
            ],
            [
                'key' => 'admin_logo_light',
                'name' => 'Admin Panel Logosu (Açık Mod)',
                'value' => '',
                'type' => 'image',
                'group' => 'appearance',
                'is_public' => false,
                'order' => 2,
            ],
            [
                'key' => 'admin_logo_dark',
                'name' => 'Admin Panel Logosu (Koyu Mod)',
                'value' => '',
                'type' => 'image',
                'group' => 'appearance',
                'is_public' => false,
                'order' => 3,
            ],
            [
                'key' => 'admin_logo_height',
                'name' => 'Admin Logo Yüksekliği',
                'value' => '2.5rem',
                'type' => 'text',
                'group' => 'appearance',
                'is_public' => false,
                'order' => 4,
            ],
            [
                'key' => 'favicon',
                'name' => 'Favicon',
                'value' => '',
                'type' => 'image',
                'group' => 'appearance',
                'is_public' => true,
                'order' => 5,
            ],
            [
                'key' => 'footer_logo',
                'name' => 'Footer Logosu',
                'value' => '',
                'type' => 'image',
                'group' => 'appearance',
                'is_public' => true,
                'order' => 6,
            ],
            [
                'key' => 'mobile_logo',
                'name' => 'Mobil Logo',
                'value' => '',
                'type' => 'image',
                'group' => 'appearance',
                'is_public' => true,
                'order' => 7,
            ],
        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }

    private function createMailSettings(): void
    {
        $settings = [
            [
                'key' => 'admin_email',
                'name' => 'Yönetici E-posta Adresi',
                'value' => 'admin@kurumsalajans.com',
                'type' => 'email',
                'group' => 'mail',
                'is_public' => false,
                'order' => 1,
            ],
            [
                'key' => 'mail_from_address',
                'name' => 'Gönderen E-posta Adresi',
                'value' => 'noreply@kurumsalajans.com',
                'type' => 'email',
                'group' => 'mail',
                'is_public' => false,
                'order' => 2,
            ],
            [
                'key' => 'mail_from_name',
                'name' => 'Gönderen Adı',
                'value' => 'Kurumsal Web Sitesi',
                'type' => 'text',
                'group' => 'mail',
                'is_public' => false,
                'order' => 3,
            ],
            [
                'key' => 'mail_mailer',
                'name' => 'Mail Sürücü',
                'value' => 'smtp',
                'type' => 'text',
                'group' => 'mail',
                'is_public' => false,
                'order' => 4,
            ],
            [
                'key' => 'mail_host',
                'name' => 'SMTP Host',
                'value' => 'smtp.gmail.com',
                'type' => 'text',
                'group' => 'mail',
                'is_public' => false,
                'order' => 5,
            ],
            [
                'key' => 'mail_port',
                'name' => 'SMTP Port',
                'value' => '587',
                'type' => 'text',
                'group' => 'mail',
                'is_public' => false,
                'order' => 6,
            ],
            [
                'key' => 'mail_username',
                'name' => 'SMTP Kullanıcı Adı',
                'value' => '',
                'type' => 'email',
                'group' => 'mail',
                'is_public' => false,
                'order' => 7,
            ],
            [
                'key' => 'mail_password',
                'name' => 'SMTP Şifre',
                'value' => '',
                'type' => 'password',
                'group' => 'mail',
                'is_public' => false,
                'order' => 8,
            ],
            [
                'key' => 'mail_encryption',
                'name' => 'SMTP Şifreleme',
                'value' => 'tls',
                'type' => 'text',
                'group' => 'mail',
                'is_public' => false,
                'order' => 9,
            ],
            [
                'key' => 'mail_send_user_notifications',
                'name' => 'Kullanıcılara Bildirim Gönder',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'mail',
                'is_public' => false,
                'order' => 10,
            ],
            [
                'key' => 'mail_contact_thank_you_subject',
                'name' => 'İletişim Teşekkür Mail Konusu',
                'value' => 'Mesajınız Alındı - Teşekkürler',
                'type' => 'text',
                'group' => 'mail',
                'is_public' => false,
                'order' => 11,
            ],
            [
                'key' => 'mail_brand_brief_thank_you_subject',
                'name' => 'Marka Analizi Teşekkür Mail Konusu',
                'value' => 'Marka Analizi Talebiniz Alındı',
                'type' => 'text',
                'group' => 'mail',
                'is_public' => false,
                'order' => 12,
            ],
            [
                'key' => 'mail_subscription_thank_you_subject',
                'name' => 'Abonelik Teşekkür Mail Konusu',
                'value' => 'E-bülten Aboneliğiniz Onaylandı',
                'type' => 'text',
                'group' => 'mail',
                'is_public' => false,
                'order' => 13,
            ],
        ];
        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }

    private function createSystemSettings(): void
    {
        $settings = [
            [
                'key' => 'app_name',
                'name' => 'Uygulama Adı',
                'value' => 'Kurumsal Web Sitesi',
                'type' => 'text',
                'group' => 'system',
                'is_public' => true,
                'order' => 1,
            ],
            [
                'key' => 'app_url',
                'name' => 'Uygulama URL',
                'value' => 'https://kurumsalajans.com',
                'type' => 'url',
                'group' => 'system',
                'is_public' => true,
                'order' => 2,
            ],
            [
                'key' => 'app_debug',
                'name' => 'Debug Modu',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'system',
                'is_public' => false,
                'order' => 3,
            ],
            [
                'key' => 'redis_client',
                'name' => 'Redis İstemcisi',
                'value' => 'phpredis',
                'type' => 'select',
                'options' => "phpredis: PhpRedis\npredis: Predis",
                'group' => 'system',
                'is_public' => false,
                'order' => 7,
            ],
            [
                'key' => 'redis_host',
                'name' => 'Redis Sunucusu',
                'value' => '127.0.0.1',
                'type' => 'text',
                'group' => 'system',
                'is_public' => false,
                'order' => 8,
            ],
            [
                'key' => 'redis_password',
                'name' => 'Redis Şifresi',
                'value' => 'null',
                'type' => 'text',
                'group' => 'system',
                'is_public' => false,
                'order' => 9,
            ],
            [
                'key' => 'redis_port',
                'name' => 'Redis Port',
                'value' => '6379',
                'type' => 'number',
                'group' => 'system',
                'is_public' => false,
                'order' => 10,
            ],
        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
