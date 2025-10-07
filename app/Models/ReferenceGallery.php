<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceGallery extends Model
{
    use HasFactory;

    protected $table = 'reference_galleries';

    protected $fillable = [
        'reference_id',
        'img',
        'order_number',
        'is_active',
    ];

    public function reference()
    {
        return $this->belongsTo(Reference::class, 'reference_id', 'id');
    }
}
