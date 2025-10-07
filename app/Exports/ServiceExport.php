<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ServiceExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Service::with('service_category')->get([
            'id',
            'service_category_id',
            'img',
            'title',
            'slug',
            'desc',
            'seo_title',
            'seo_key',
            'seo_desc',
            'is_active',
            'is_home',
            'sort_order',
            'published_at',
            'created_at',
            'updated_at'
        ]);
    }

    public function map($service): array
    {
        return [
            $service->id,
            $service->service_category ? $service->service_category->title : '-',
            $service->img ? 'Var' : 'Yok',
            $service->title,
            $service->slug,
            strip_tags($service->desc ?? '-'), // HTML taglarını temizle
            $service->seo_title ?? '-',
            is_array($service->seo_key) ? implode(', ', $service->seo_key) : ($service->seo_key ?? '-'),
            $service->seo_desc ?? '-',
            $service->is_active ? 'Aktif' : 'Pasif',
            $service->is_home ? 'Evet' : 'Hayır',
            $service->sort_order ?? '-',
            $service->published_at ? $service->published_at->format('d.m.Y H:i') : '-',
            $service->created_at->format('d.m.Y H:i'),
            $service->updated_at->format('d.m.Y H:i'),
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
            'Sıralama',
            'Yayın Tarihi',
            'Oluşturulma',
            'Güncellenme',
        ];
    }
}
