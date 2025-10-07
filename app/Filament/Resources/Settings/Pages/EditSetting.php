<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Her field tipine göre doğru değeri value field'ına ata
        switch ($data['type']) {
            case 'text':
            case 'email':
            case 'url':
            case 'number':
                $data['value'] = $data['value_text'] ?? '';
                break;
            case 'textarea':
                $data['value'] = $data['value_textarea'] ?? '';
                break;
            case 'boolean':
                $data['value'] = ($data['value_boolean'] ?? false) ? '1' : '0';
                break;
            case 'select':
                $data['value'] = $data['value_select'] ?? '';
                break;
            case 'image':
                $data['value'] = $data['value_image'] ?? '';
                break;
        }

        // Geçici field'ları temizle
        unset($data['value_text'], $data['value_textarea'], $data['value_boolean'], $data['value_select'], $data['value_image']);

        return $data;
    }
    protected function getRedirectUrl(): string
    {
        // Kullanıcının hangi grup tab'ından geldiğini belirle
        $record = $this->getRecord();
        $activeTab = $this->determineActiveTab($record->group);

        return static::getResource()::getUrl('index') . '?activeTab=' . $activeTab;
    }

    private function determineActiveTab(string $group): string
    {
        // Grup adına göre tab key'ini belirle
        $tabMapping = [
            'general' => 'general',
            'contact' => 'contact',
            'social' => 'social',
            'seo' => 'seo',
            'appearance' => 'appearance',
            'mail' => 'mail',
            'system' => 'system',
        ];

        return $tabMapping[$group] ?? 'general';
    }
}
