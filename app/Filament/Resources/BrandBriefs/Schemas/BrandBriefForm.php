<?php

namespace App\Filament\Resources\BrandBriefs\Schemas;

use App\Models\BrandBrief;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BrandBriefForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Marka Bilgileri')
                    ->description('Temel marka bilgileri ve iletişim detayları')
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                TextInput::make('brand_name')
                                    ->label('Marka Adı')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                TextInput::make('website')
                                    ->label('Website')
                                    ->url()
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                TextInput::make('sector')
                                    ->label('Sektör')
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                TextInput::make('years_active')
                                    ->label('Faaliyet Yılı')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(200)
                                    ->columnSpanFull(),
                            ]),

                        Textarea::make('brand_summary')
                            ->label('Marka Özeti')
                            ->rows(3)
                            ->columnSpanFull(),

                        TagsInput::make('social_links')
                            ->label('Sosyal Medya Linkleri')
                            ->placeholder('Sosyal medya linklerini girin')
                            ->columnSpanFull(),
                    ])->columns(1),

                Section::make('Hedefler ve Konumlama')
                    ->description('Marka hedefleri, hedef kitle ve pazar konumlandırması')
                    ->schema([
                        Textarea::make('target_audience')
                            ->label('Hedef Kitle')
                            ->rows(3),

                        TagsInput::make('priority_goals')
                            ->label('Öncelikli Hedefler')
                            ->placeholder('Hedefleri girin'),

                        RichEditor::make('competitor_analysis')
                            ->label('Rakip Analizi')
                            ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList'])
                            ->columnSpanFull(),

                        Textarea::make('market_position')
                            ->label('Pazar Konumu')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Marka Karakteristikleri')
                    ->description('Markanın güçlü ve zayıf yönleri')
                    ->schema([
                        TextInput::make('three_words')
                            ->label('Üç Kelime ile Marka')
                            ->maxLength(255),

                        Textarea::make('strength')
                            ->label('Güçlü Yönler')
                            ->rows(3),

                        Textarea::make('edge_against_competitors')
                            ->label('Rakiplere Karşı Avantajları')
                            ->rows(3),

                        Textarea::make('weakness')
                            ->label('Zayıf Yönler')
                            ->rows(3),
                    ])->columns(2),

                Section::make('Pazarlama ve Sosyal Medya')
                    ->description('Mevcut pazarlama durumu ve sosyal medya yönetimi')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Toggle::make('has_social_management')
                                    ->label('Sosyal Medya Yönetimi Var mı?'),

                                Toggle::make('outsourced_social')
                                    ->label('Sosyal Medya Dışarıdan mı?'),
                            ]),

                        TagsInput::make('marketing_tools')
                            ->label('Kullanılan Pazarlama Araçları')
                            ->placeholder('Pazarlama araçlarını girin')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Görsel Kimlik')
                    ->description('Logo, kurumsal kimlik ve görsel materyaller')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('logo_satisfaction')
                                    ->label('Logo Memnuniyeti')
                                    ->options(BrandBrief::getLogoSatisfactionOptions()),

                                Toggle::make('has_media_assets')
                                    ->label('Medya Varlıkları Var mı?'),
                            ]),

                        TagsInput::make('corporate_assets')
                            ->label('Kurumsal Varlıklar')
                            ->placeholder('Logo, kartvizit, broşür vb.')
                            ->columnSpanFull(),

                        Select::make('design_representation')
                            ->label('Tasarım Temsil Durumu')
                            ->options(BrandBrief::getYesNoUnsureOptions())
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Dijital Varlıklar')
                    ->description('Website ve dijital varlık durumu')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Toggle::make('has_website')
                                    ->label('Website Var mı?'),

                                Select::make('is_mobile_ready')
                                    ->label('Mobil Uyumlu mu?')
                                    ->options(BrandBrief::getYesNoUnsureOptions()),

                                Select::make('has_seo')
                                    ->label('SEO Çalışması Var mı?')
                                    ->options(BrandBrief::getYesNoUnsureOptions()),
                            ]),

                        Textarea::make('web_performance_feedback')
                            ->label('Web Performans Geri Bildirimi')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('İletişim Bilgileri')
                    ->description('Form gönderen kişinin iletişim bilgileri')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('full_name')
                                    ->label('Ad Soyad')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('phone')
                                    ->label('Telefon')
                                    ->tel()
                                    ->required()
                                    ->maxLength(20),

                                TextInput::make('email')
                                    ->label('E-posta')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),

                                Select::make('preferred_contact')
                                    ->label('Tercih Edilen İletişim')
                                    ->options([
                                        'phone' => 'Telefon',
                                        'email' => 'E-posta',
                                        'whatsapp' => 'WhatsApp',
                                    ]),

                                Select::make('heard_from')
                                    ->label('Bizi Nereden Duydunuz?')
                                    ->options([
                                        'google' => 'Google Arama',
                                        'social_media' => 'Sosyal Medya',
                                        'referral' => 'Referans',
                                        'advertisement' => 'Reklam',
                                        'other' => 'Diğer',
                                    ]),
                            ]),
                    ])->columns(2),

                Section::make('Admin Ayarları')
                    ->description('Yönetici tarafından düzenlenen alanlar')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('status')
                                    ->label('Durum')
                                    ->options(BrandBrief::getStatusOptions())
                                    ->default('pending')
                                    ->required(),

                                TextInput::make('ip_address')
                                    ->label('IP Adresi')
                                    ->disabled()
                                    ->dehydrated(false),

                                TextInput::make('user_agent')
                                    ->label('User Agent')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->columnSpanFull(),
                            ]),
                    ])->columns(2)
                    ->collapsible(),
            ]);
    }
}
