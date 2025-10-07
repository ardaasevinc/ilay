<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class EmailLog extends Model
{
    protected $fillable = [
        'type',
        'to_email',
        'subject',
        'content',
        'data',
        'status',
        'error_message',
        'ip_address',
        'user_agent',
        'sent_at',
    ];

    protected $casts = [
        'data' => 'array',
        'sent_at' => 'datetime',
    ];

    // Scopes
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeSuccessful($query)
    {
        return $query->where('status', 'sent');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    // Accessors
    protected function typeLabel(): Attribute
    {
        return Attribute::make(
            get: fn($value) => match ($this->type) {
                'contact' => 'İletişim Formu',
                'brand_brief' => 'Marka Analizi',
                'subscription' => 'E-bülten Aboneliği',
                default => ucfirst($this->type),
            },
        );
    }

    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn($value) => match ($this->status) {
                'sent' => 'Gönderildi',
                'failed' => 'Başarısız',
                default => ucfirst($this->status),
            },
        );
    }
}
