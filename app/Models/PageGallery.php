<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageGallery extends Model
{
    protected $fillable = [
        'page_id',
        'image',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the page that owns the gallery image
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Scope: Aktif görseller
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
