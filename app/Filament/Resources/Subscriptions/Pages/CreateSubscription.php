<?php

namespace App\Filament\Resources\Subscriptions\Pages;

use App\Filament\Resources\Subscriptions\SubscriptionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSubscription extends CreateRecord
{
    protected static string $resource = SubscriptionResource::class;

    public function getTitle(): string
    {
        return 'Abone Ol';
    }

    public function getHeading(): string
    {
        return 'Yeni Abonelik Ekle';
    }
}
