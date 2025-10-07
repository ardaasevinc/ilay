<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kullanıcı Bilgileri')
                    ->schema([
                        TextInput::make('name')
                            ->label('Ad Soyad')
                            ->required()
                            ->maxLength(255)
                            ->validationMessages([
                                'required' => 'Ad Soyad alanı zorunludur.',
                                'max' => 'Ad Soyad en fazla 255 karakter olabilir.',
                            ]),

                        TextInput::make('email')
                            ->label('E-posta')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->validationMessages([
                                'required' => 'E-posta alanı zorunludur.',
                                'email' => 'Geçerli bir e-posta adresi giriniz.',
                                'unique' => 'Bu e-posta adresi zaten kullanılıyor.',
                                'max' => 'E-posta en fazla 255 karakter olabilir.',
                            ]),

                        TextInput::make('phone')
                            ->label('Telefon')
                            ->tel()
                            ->mask('(999) 999-99-99')
                            ->placeholder('(0532) 123-45-67')
                            ->rules([
                                'nullable',
                                'regex:/^\(\d{3}\) \d{3}-\d{2}-\d{2}$/',
                            ])
                            ->validationMessages([
                                'regex' => 'Telefon numarası geçerli formatta olmalıdır. Örnek: (0532) 123-45-67'
                            ])
                            ->helperText('Format: (0532) 123-45-67')
                            ->maxLength(255),

                        Select::make('status')
                            ->label('Durum')
                            ->options([
                                'active' => 'Aktif',
                                'pending' => 'Beklemede',
                                'passive' => 'Pasif'
                            ])
                            ->default('pending')
                            ->required()
                            ->validationMessages([
                                'required' => 'Durum alanı zorunludur.',
                            ]),

                        Select::make('role')
                            ->label('Rol')
                            ->options([
                                'super_admin' => 'Süper Admin',
                                'admin' => 'Admin',
                                'editor' => 'Editör',
                                'student' => 'Öğrenci',
                            ])
                            ->default('student')
                            ->required(),
                        TextInput::make('password')
                            ->label('Şifre')
                            ->password()
                            ->required(fn($context) => $context === 'create')
                            ->dehydrated(fn($state) => filled($state))
                            ->rule(Password::default())
                            ->confirmed()
                            ->validationMessages([
                                'required' => 'Şifre alanı zorunludur.',
                                'min' => 'Şifre en az 8 karakter olmalıdır.',
                                'confirmed' => 'Şifre onayı eşleşmiyor.',
                            ])
                            ->helperText('En az 8 karakter, büyük harf, küçük harf ve sayı içermelidir.'),

                        TextInput::make('password_confirmation')
                            ->label('Şifre Onayı')
                            ->password()
                            ->required(fn($context) => $context === 'create')
                            ->dehydrated(false)
                            ->validationMessages([
                                'required' => 'Şifre onayı zorunludur.',
                            ]),
                    ]),

                Section::make('Avatar')
                    ->schema([
                        FileUpload::make('avatar')
                            ->label('Avatar')
                            ->disk('uploads')
                            ->directory('avatars')
                            ->image()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/gif',
                                'image/webp',
                                'image/svg+xml',
                            ])
                            ->imagePreviewHeight('150')
                            ->panelLayout('integrated')
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                    ])
                    ->collapsible(),
            ]);
    }
}
