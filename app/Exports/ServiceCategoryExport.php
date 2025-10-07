<?php

namespace App\Exports;

use App\Models\ServiceCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ServiceCategoryExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return ServiceCategory::all([
            'id',
            'img',
            'title',
            'slug',
            'desc',
            'seo_title',
            'seo_key',
            'seo_desc',
            'is_active',
            'sort_order',
            'published_at',
            'created_at',
            'updated_at'
        ]);
    }

    public function map($category): array
    {
        return [
            $category->id,
            $category->img ? 'Var' : 'Yok',
            $category->title,
            $category->slug,
            strip_tags($category->desc ?? '-'), // HTML taglarını temizle
            $category->seo_title ?? '-',
            is_array($category->seo_key) ? implode(', ', $category->seo_key) : ($category->seo_key ?? '-'),
            $category->seo_desc ?? '-',
            $category->is_active ? 'Aktif' : 'Pasif',
            $category->sort_order ?? '-',
            $category->published_at ? $category->published_at->format('d.m.Y H:i') : '-',
            $category->created_at->format('d.m.Y H:i'),
            $category->updated_at->format('d.m.Y H:i'),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Görsel',
            'Başlık',
            'Slug',
            'Açıklama',
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
