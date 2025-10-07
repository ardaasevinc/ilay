<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TagsInput;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Sayfa İçeriği')
                ->schema([
                    FileUpload::make('img')->label('Kapak Görseli')->disk('uploads')->directory('pages')->image()->imageEditor()->imageEditorAspectRatios(['16:9', '4:3', '1:1'])->imageResizeTargetWidth(1200)->imageResizeTargetHeight(675)->maxSize(5120)->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])->helperText('Önerilen boyut: 1200x675 (16:9)')->visibility('public')->downloadable()->previewable(),
                    TextInput::make('title')->label('Sayfa Başlığı')->required()->live(onBlur: true)->afterStateUpdated(function (string $operation, $state, callable $set) {
                        if ($operation !== 'create') return;
                        $set('slug', \Illuminate\Support\Str::slug($state));
                    }),
                    TextInput::make('slug')->label('URL Slug')->required()->unique(ignoreRecord: true)->rule('alpha_dash')->helperText('SEO dostu URL için kullanılır')->disabled(),
                    RichEditor::make('desc')->label('Sayfa İçeriği')->required()->fileAttachmentsDisk('uploads')->fileAttachmentsDirectory('pages/attachments')->fileAttachmentsVisibility('public')->toolbarButtons(['attachFiles', 'bold', 'italic', 'underline', 'strike', 'h2', 'h3', 'blockquote', 'codeBlock', 'orderedList', 'bulletList', 'link', 'horizontalRule', 'undo', 'redo'])->extraAttributes(['style' => 'min-height: 350px;']),
                ])->columnSpan(2),
            Section::make('Sayfa Ayarları')
                ->schema([
                    Section::make('SEO Ayarları')
                        ->schema([
                            TextInput::make('seo_title')->label('SEO Başlık')->maxLength(60)->helperText('Maksimum 60 karakter'),
                            TagsInput::make('seo_key')->label('Anahtar Kelimeler')->separator(',')->rules(['array', 'max:8'])->helperText('Maksimum 8 anahtar kelime girebilirsiniz. Enter ile yeni kelime ekleyin.'),
                            Textarea::make('seo_desc')->label('SEO Açıklama')->rows(3)->maxLength(160)->helperText('Maksimum 160 karakter'),
                        ]),
                    Section::make('Yayın Ayarları')
                        ->schema([
                            Toggle::make('is_active')->label('Aktif')->default(true),
                            DateTimePicker::make('published_at')->label('Yayınlanma Tarihi')->default(now())->helperText('Sayfanın yayınlanacağı tarih'),
                        ]),
                ])->columnSpan(1),
        ])->columns(3);
    }
}
