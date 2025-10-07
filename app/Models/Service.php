<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'services';

    protected $fillable = [
        'service_category_id',
        'img',
        'title',
        'slug',
        'desc',
        'seo_title',
        'seo_key',
        'seo_desc',
        'is_active',
        'is_home',
        'sort_order',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_home' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function service_category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
    }

    public function galleries()
    {
        return $this->hasMany(ServiceGallery::class, 'service_id', 'id');
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class, 'reference_service')
            ->withPivot('position')
            ->orderBy('reference_service.position');
    }
}
