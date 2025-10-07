<?php

namespace App\Filament\Resources\EmailLogs\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Schemas\Schema;

class EmailLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Select::make('type')
                    ->label('Tür')
                    ->options([
                        'contact' => 'İletişim Formu',
                        'brand_brief' => 'Marka Analizi',
                        'subscription' => 'E-bülten Aboneliği',
                    ])
                    ->disabled()
                    ->dehydrated(false),

                Select::make('status')
                    ->label('Durum')
                    ->options([
                        'sent' => 'Gönderildi',
                        'failed' => 'Başarısız',
                    ])
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('to_email')
                    ->label('Alıcı E-posta')
                    ->disabled()
                    ->dehydrated(false),

                DateTimePicker::make('sent_at')
                    ->label('Gönderim Tarihi')
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('subject')
                    ->label('Konu')
                    ->disabled()
                    ->dehydrated(false)
                    ->columnSpanFull(),

                Textarea::make('content')
                    ->label('İçerik')
                    ->disabled()
                    ->dehydrated(false)
                    ->rows(5)
                    ->columnSpanFull(),

                Textarea::make('error_message')
                    ->label('Hata Mesajı')
                    ->disabled()
                    ->dehydrated(false)
                    ->visible(fn($record) => $record?->status === 'failed')
                    ->rows(3)
                    ->columnSpanFull(),

                KeyValue::make('data')
                    ->label('Gönderilen Veriler')
                    ->disabled()
                    ->dehydrated(false)
                    ->columnSpanFull(),

                TextInput::make('ip_address')
                    ->label('IP Adresi')
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('user_agent')
                    ->label('Tarayıcı Bilgisi')
                    ->disabled()
                    ->dehydrated(false),
            ]);
    }
}
