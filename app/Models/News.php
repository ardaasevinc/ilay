<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $news_category_id
 * @property string $img
 * @property string $title
 * @property string $slug
 * @property string $desc
 * @property string $seo_title
 * @property string $seo_key
 * @property string $seo_desc
 * @property int $is_active
 * @property int $is_home
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\NewsCategory|null $news_category
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereIsHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereNewsCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSeoDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSeoKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'news_category_id',
        'img',
        'title',
        'slug',
        'desc',
        'seo_title',
        'seo_key',
        'seo_desc',
        'is_active',
        'is_home',
    ];

    // Accessor for content - using desc field as content
    public function getContentAttribute()
    {
        return $this->desc;
    }

    // Accessor for featured_image - using img field
    public function getFeaturedImageAttribute()
    {
        return $this->img;
    }

    // Accessor for category - alias for news_category relationship
    public function getCategoryAttribute()
    {
        return $this->news_category;
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    public static function getPreviousPost($currentPostId)
    {
        return self::where('id', '<', $currentPostId)->orderBy('id', 'desc')->first();
    }

    public static function getNextPost($currentPostId)
    {
        return self::where('id', '>', $currentPostId)->orderBy('id', 'asc')->first();
    }

    public function news_category()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id', 'id');
    }

    /**
     * Relationship: One-to-Many with NewsGallery
     */
    public function galleries()
    {
        return $this->hasMany(NewsGallery::class, 'news_id', 'id')
            ->orderBy('order_number');
    }
}
