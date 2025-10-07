<?php

namespace App\Exports;

use App\Models\NewsCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NewsCategoryExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return NewsCategory::all(['id', 'img', 'title', 'slug', 'seo_title', 'seo_key', 'seo_desc', 'is_active', 'created_at', 'updated_at']);
    }

    public function map($category): array
    {
        return [
            $category->id,
            $category->img ? 'Var' : 'Yok',
            $category->title,
            $category->slug,
            $category->seo_title ?? '-',
            is_array($category->seo_key) ? implode(', ', $category->seo_key) : ($category->seo_key ?? '-'),
            $category->seo_desc ?? '-',
            $category->is_active ? 'Aktif' : 'Pasif',
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
            'SEO Başlık',
            'Anahtar Kelimeler',
            'SEO Açıklama',
            'Durum',
            'Oluşturulma',
            'Güncellenme',
        ];
    }
}
