<?php

namespace App\Exports;

use App\Models\Page;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PageExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Page::all(['id', 'img', 'title', 'slug', 'desc', 'seo_title', 'seo_key', 'seo_desc', 'is_active', 'sort_order', 'published_at', 'created_at', 'updated_at']);
    }

    public function map($page): array
    {
        return [
            $page->id,
            $page->img ? 'Var' : 'Yok',
            $page->title,
            $page->slug,
            strip_tags($page->desc ?? '-'), // HTML taglarını temizle
            $page->seo_title ?? '-',
            is_array($page->seo_key) ? implode(', ', $page->seo_key) : ($page->seo_key ?? '-'),
            $page->seo_desc ?? '-',
            $page->is_active ? 'Aktif' : 'Pasif',
            $page->sort_order ?? '-',
            $page->published_at ? $page->published_at->format('d.m.Y H:i') : '-',
            $page->created_at->format('d.m.Y H:i'),
            $page->updated_at->format('d.m.Y H:i'),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Görsel',
            'Başlık',
            'Slug',
            'İçerik',
            'SEO Başlık',
            'Anahtar Kelimeler',
            'SEO Açıklama',
            'Durum',
            'Sıralama',
            'Yayın Tarihi',
            'Oluşturulma',
            'Güncellenme',
        ];
    }
}
