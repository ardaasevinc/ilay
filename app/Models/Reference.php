<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reference extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'references';

    protected $fillable = [
        'img',
        'title',
        'slug',
        'desc',
        'url',
        'seo_title',
        'seo_key',
        'seo_desc',
        'is_active',
        'is_home',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_home' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class)
            ->withPivot('position')
            ->orderBy('reference_service.position');
    }

    public function galleries()
    {
        return $this->hasMany(ReferenceGallery::class, 'reference_id', 'id')
            ->orderBy('order_number');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeHome($query)
    {
        return $query->where('is_home', true)->orderBy('sort_order');
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at ? $this->created_at->format('d.m.Y H:i') : '';
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return $this->updated_at ? $this->updated_at->format('d.m.Y H:i') : '';
    }

    public function getServicesTextAttribute()
    {
        return $this->services->pluck('title')->join(', ');
    }

    public function getLimitedServicesTextAttribute()
    {
        $services = $this->services->take(3)->pluck('title');
        $text = $services->join(', ');
        if ($this->services->count() > 3) {
            $text .= '...';
        }
        return $text;
    }

    public function getPrimaryServiceAttribute()
    {
        return $this->services->first()?->title;
    }
}
