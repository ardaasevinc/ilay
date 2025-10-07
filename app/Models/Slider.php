<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $img
 * @property string $title
 * @property string $description
 * @property int $type_id
 * @property string|null $type_content
 * @property int $is_active
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\News|null $news
 * @property-read \App\Models\Page|null $page
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTypeContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'img',
        'title',
        'description',
        'type_id',
        'type_content',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'type_id' => 'integer',
    ];

    /**
     * Scope to get only active sliders
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order sliders
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'type_content');
    }

    public function news()
    {
        return $this->belongsTo(News::class, 'type_content');
    }

    /**
     * Get the related content based on type_id
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getRelatedContent()
    {
        return match ($this->type_id) {
            1 => null, // Direct URL, no model relation
            2 => $this->type_content ? Page::find($this->type_content) : null,
            3 => $this->type_content ? News::find($this->type_content) : null,
            4 => $this->type_content ? Service::find($this->type_content) : null,
            5 => $this->type_content ? ServiceCategory::find($this->type_content) : null,
            default => null,
        };
    }

    /**
     * Get type names
     */
    public function getTypeNameAttribute()
    {
        return match ($this->type_id) {
            1 => 'Direkt URL',
            2 => 'Sayfa',
            3 => 'Haber',
            default => 'Bilinmiyor',
        };
    }

    /**
     * Get slider types for select options
     */
    public static function getTypes(): array
    {
        return [
            1 => 'Direkt URL',
            2 => 'Sayfa',
            3 => 'Haber',
        ];
    }
}
