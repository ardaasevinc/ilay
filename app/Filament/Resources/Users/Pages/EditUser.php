<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Kullanıcının mevcut rolünü form'a yükle
        if ($this->record && $this->record->roles->isNotEmpty()) {
            $data['role'] = $this->record->roles->first()->name;
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Role alanını kaldır, çünkü user tablosunda yok
        $role = $data['role'] ?? null;
        unset($data['role']);

        return $data;
    }

    protected function afterSave(): void
    {
        // Kullanıcının rolünü güncelle
        $roleValue = $this->form->getState()['role'] ?? 'student';

        // Önce tüm rolleri kaldır
        $this->record->syncRoles([]);

        // Yeni rolü ata
        $this->record->assignRole($roleValue);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
