<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Role alanını kaldır, çünkü user tablosunda yok
        $role = $data['role'] ?? 'student';
        unset($data['role']);

        return $data;
    }

    protected function afterCreate(): void
    {
        // Kullanıcının rolünü ata
        $roleValue = $this->form->getState()['role'] ?? 'student';
        $this->record->assignRole($roleValue);
    }
}
