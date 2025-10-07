<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandBrief extends Model
{
    use HasFactory;

    protected $fillable = [
        // Marka Bilgileri
        'brand_name',
        'website',
        'social_links',
        'sector',
        'years_active',

        // Step 1'e taşındı
        'brand_summary',
        'target_audience',

        // Hedefler & Konumlama
        'priority_goals',
        'competitor_analysis',
        'market_position',

        // Mevcut Durum
        'three_words',
        'strength',
        'edge_against_competitors',
        'weakness',
        'has_social_management',
        'outsourced_social',
        'marketing_tools',

        // Görsel Kimlik
        'logo_satisfaction',
        'corporate_assets',
        'has_media_assets',
        'design_representation',

        // Dijital
        'has_website',
        'is_mobile_ready',
        'has_seo',
        'web_performance_feedback',

        // İletişim
        'full_name',
        'phone',
        'email',
        'preferred_contact',
        'heard_from',

        // Admin alanları
        'status',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'priority_goals' => 'array',
        'marketing_tools' => 'array',
        'corporate_assets' => 'array',
        'has_social_management' => 'boolean',
        'outsourced_social' => 'boolean',
        'has_media_assets' => 'boolean',
        'has_website' => 'boolean',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_IN_REVIEW = 'in_review';
    const STATUS_COMPLETED = 'completed';

    public static function getStatusOptions(): array
    {
        return [
            self::STATUS_PENDING => 'Bekliyor',
            self::STATUS_IN_REVIEW => 'İnceleniyor',
            self::STATUS_COMPLETED => 'Tamamlandı',
        ];
    }

    // Logo satisfaction options
    public static function getLogoSatisfactionOptions(): array
    {
        return [
            'yes' => 'Evet',
            'no' => 'Hayır',
            'partially' => 'Kısmen',
        ];
    }

    // Yes/No/Not Sure options
    public static function getYesNoUnsureOptions(): array
    {
        return [
            'yes' => 'Evet',
            'no' => 'Hayır',
            'not_sure' => 'Emin değilim',
        ];
    }

    // Design representation options
    public static function getDesignRepresentationOptions(): array
    {
        return [
            'yes' => 'Evet',
            'no' => 'Hayır',
            'not_sure' => 'Emin değilim',
        ];
    }

    // Preferred contact options
    public static function getPreferredContactOptions(): array
    {
        return [
            'phone' => 'Telefon',
            'whatsapp' => 'WhatsApp',
            'email' => 'E-posta',
        ];
    }

    // Heard from options
    public static function getHeardFromOptions(): array
    {
        return [
            'instagram' => 'Instagram',
            'google' => 'Google',
            'referral' => 'Öneri',
            'other' => 'Diğer',
        ];
    }

    // Priority goals options
    public static function getPriorityGoalsOptions(): array
    {
        return [
            'brand_awareness' => 'Marka Bilinirliği',
            'sales_increase' => 'Satış Artışı',
            'customer_loyalty' => 'Müşteri Sadakati',
            'market_expansion' => 'Pazar Genişlemesi',
            'digital_transformation' => 'Dijital Dönüşüm',
            'cost_reduction' => 'Maliyet Azaltma',
        ];
    }

    // Marketing tools options
    public static function getMarketingToolsOptions(): array
    {
        return [
            'social_media' => 'Sosyal Medya',
            'google_ads' => 'Google Ads',
            'seo' => 'SEO',
            'email_marketing' => 'E-posta Pazarlama',
            'content_marketing' => 'İçerik Pazarlama',
            'influencer_marketing' => 'Influencer Pazarlama',
            'traditional_advertising' => 'Geleneksel Reklam',
            'other' => 'Diğer',
        ];
    }

    // Corporate assets options
    public static function getCorporateAssetsOptions(): array
    {
        return [
            'logo' => 'Logo',
            'colors' => 'Kurumsal Renkler',
            'typography' => 'Tipografi',
            'business_card' => 'Kartvizit',
            'letterhead' => 'Antetli Kağıt',
            'brochure' => 'Broşür',
            'presentation_template' => 'Sunum Şablonu',
        ];
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeInReview($query)
    {
        return $query->where('status', self::STATUS_IN_REVIEW);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    // Accessors
    public function getStatusLabelAttribute(): string
    {
        return self::getStatusOptions()[$this->status] ?? $this->status;
    }

    public function getLogoSatisfactionLabelAttribute(): ?string
    {
        return $this->logo_satisfaction ? self::getLogoSatisfactionOptions()[$this->logo_satisfaction] ?? $this->logo_satisfaction : null;
    }

    public function getIsMobileReadyLabelAttribute(): ?string
    {
        return $this->is_mobile_ready ? self::getYesNoUnsureOptions()[$this->is_mobile_ready] ?? $this->is_mobile_ready : null;
    }

    public function getHasSeoLabelAttribute(): ?string
    {
        return $this->has_seo ? self::getYesNoUnsureOptions()[$this->has_seo] ?? $this->has_seo : null;
    }

    public function getDesignRepresentationLabelAttribute(): ?string
    {
        return $this->design_representation ? self::getDesignRepresentationOptions()[$this->design_representation] ?? $this->design_representation : null;
    }

    public function getPreferredContactLabelAttribute(): ?string
    {
        return $this->preferred_contact ? self::getPreferredContactOptions()[$this->preferred_contact] ?? $this->preferred_contact : null;
    }

    public function getHeardFromLabelAttribute(): ?string
    {
        return $this->heard_from ? self::getHeardFromOptions()[$this->heard_from] ?? $this->heard_from : null;
    }

    // Mutators
    public function setSocialLinksAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['social_links'] = implode("\n", array_filter($value));
        } else {
            $this->attributes['social_links'] = $value;
        }
    }

    public function getSocialLinksAttribute($value): array
    {
        return $value ? explode("\n", $value) : [];
    }
}
