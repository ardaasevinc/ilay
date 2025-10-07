<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $news_id
 * @property string $img
 * @property int $order_number
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\News|null $news
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereNewsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NewsGallery extends Model
{
    use HasFactory;

    protected $table = 'news_galleries';

    protected $fillable = [
        'news_id',
        'img',
        'order_number',
        'is_active',
    ];

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id', 'id');
    }
}
