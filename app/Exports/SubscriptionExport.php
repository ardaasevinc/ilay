<?php

namespace App\Exports;

use App\Models\Subscription;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubscriptionExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Subscription::select('id', 'email', 'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'E-posta',
            'Kayıt Tarihi',
        ];
    }
}
