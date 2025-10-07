<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Abonelik Bilgileri')
                    ->description('Bülten aboneliği için e-posta adresi bilgileri')
                    ->schema([
                        TextInput::make('email')
                            ->label('E-posta Adresi')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('ip_address')
                            ->label('IP Adresi')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('user_agent')
                            ->label('Tarayıcı Bilgisi')
                            ->disabled()
                            ->dehydrated(false),
                    ])->columns(1),
            ]);
    }
}
