<?php

namespace App\Exports;

use App\Models\EmailLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Builder;

class EmailLogsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $query;

    public function __construct(Builder $query = null)
    {
        $this->query = $query;
    }

    public function collection()
    {
        if ($this->query) {
            return $this->query->orderBy('created_at', 'desc')->get();
        }

        return EmailLog::orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tür',
            'Alıcı E-posta',
            'Konu',
            'Durum',
            'Hata Mesajı',
            'IP Adresi',
            'Tarayıcı Bilgisi',
            'Gönderim Tarihi',
            'Oluşturulma Tarihi',
        ];
    }

    public function map($emailLog): array
    {
        return [
            $emailLog->id,
            $this->getTypeLabel($emailLog->type),
            $emailLog->to_email,
            $emailLog->subject,
            $this->getStatusLabel($emailLog->status),
            $emailLog->error_message,
            $emailLog->ip_address,
            $emailLog->user_agent,
            $emailLog->sent_at ? $emailLog->sent_at->format('d.m.Y H:i:s') : '',
            $emailLog->created_at->format('d.m.Y H:i:s'),
        ];
    }

    private function getTypeLabel(string $type): string
    {
        return match ($type) {
            'contact' => 'İletişim Formu',
            'brand_brief' => 'Marka Analizi',
            'subscription' => 'E-bülten Aboneliği',
            default => ucfirst($type),
        };
    }

    private function getStatusLabel(string $status): string
    {
        return match ($status) {
            'sent' => 'Gönderildi',
            'failed' => 'Başarısız',
            default => ucfirst($status),
        };
    }
}
