<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    protected $table = 'news_categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'img',
        'title',
        'slug',
        'seo_title',
        'seo_key',
        'seo_desc',
        'is_active',
    ];

    protected $appends = [
        'category_news_count'
    ];

    // Accessor for name - using title field
    public function getNameAttribute()
    {
        return $this->title;
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    public function getCategoryNewsCountAttribute()
    {
        return News::where('news_category_id', $this->id)->count();
    }

    public function news()
    {
        return $this->hasMany(News::class, 'news_category_id', 'id');
    }
}
