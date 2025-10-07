<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Section::make('İletişim Mesajı Bilgileri')
                    ->description('Ziyaretçilerin gönderdiği iletişim mesajı bilgileri')
                    ->schema([
                        TextInput::make('name')
                            ->label('Ad Soyad')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('E-posta Adresi')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('subject')
                            ->label('Konu')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('message')
                            ->label('Mesaj')
                            ->required()
                            ->rows(5)
                            ->maxLength(2000),

                        TextInput::make('ip_address')
                            ->label('IP Adresi')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('user_agent')
                            ->label('Tarayıcı Bilgisi')
                            ->disabled()
                            ->dehydrated(false),

                        DateTimePicker::make('created_at')
                            ->label('Oluşturulma Tarihi')
                            ->disabled()
                            ->dehydrated(false),
                    ])->columns(1),
            ]);
    }
}
