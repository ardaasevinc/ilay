<?php

namespace App\Exports;

use App\Models\Reference;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReferenceExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $query;

    public function __construct($query = null)
    {
        $this->query = $query;
    }

    public function collection()
    {
        if ($this->query) {
            return $this->query->with('services')->get();
        }

        return Reference::with('services')->orderBy('sort_order')->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Başlık',
            'URL Slug',
            'Website URL',
            'Verilen Hizmetler',
            'Durumu',
            'Anasayfa',
            'Sıra',
            'Oluşturulma Tarihi',
            'Güncellenme Tarihi',
        ];
    }

    public function map($reference): array
    {
        return [
            $reference->id,
            $reference->title,
            $reference->slug,
            $reference->url,
            $reference->services_text ?: '-',
            $reference->is_active ? 'Aktif' : 'Pasif',
            $reference->is_home ? 'Evet' : 'Hayır',
            $reference->sort_order,
            $reference->created_at->format('d.m.Y H:i'),
            $reference->updated_at->format('d.m.Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
