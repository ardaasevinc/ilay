<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'img',
        'title',
        'slug',
        'desc',
        'seo_title',
        'seo_key',
        'seo_desc',
        'is_active',
        'sort_order',
        'published_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Get the page's gallery images
     */
    public function galleries()
    {
        return $this->hasMany(PageGallery::class, 'page_id', 'id')
            ->orderBy('sort_order');
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Otomatik slug oluşturma
        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });

        static::updating(function ($page) {
            if ($page->isDirty('title') && empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    /**
     * Scope: Aktif sayfalar
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Yayınlanmış sayfalar
     */
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
