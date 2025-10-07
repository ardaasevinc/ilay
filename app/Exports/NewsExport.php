<?php

namespace App\Exports;

use App\Models\News;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NewsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return News::with('news_category')->get(['id', 'news_category_id', 'img', 'title', 'slug', 'desc', 'seo_title', 'seo_key', 'seo_desc', 'is_active', 'is_home', 'created_at', 'updated_at']);
    }

    public function map($news): array
    {
        return [
            $news->id,
            $news->news_category ? $news->news_category->title : '-',
            $news->img ? 'Var' : 'Yok',
            $news->title,
            $news->slug,
            strip_tags($news->desc ?? '-'), // HTML taglarını temizle
            $news->seo_title ?? '-',
            is_array($news->seo_key) ? implode(', ', $news->seo_key) : ($news->seo_key ?? '-'),
            $news->seo_desc ?? '-',
            $news->is_active ? 'Aktif' : 'Pasif',
            $news->is_home ? 'Evet' : 'Hayır',
            $news->created_at->format('d.m.Y H:i'),
            $news->updated_at->format('d.m.Y H:i'),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kategori',
            'Görsel',
            'Başlık',
            'Slug',
            'İçerik',
            'SEO Başlık',
            'Anahtar Kelimeler',
            'SEO Açıklama',
            'Durum',
            'Ana Sayfa',
            'Oluşturulma',
            'Güncellenme',
        ];
    }
}
