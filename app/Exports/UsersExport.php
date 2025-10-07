<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $query;

    public function __construct($query = null)
    {
        $this->query = $query;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->query) {
            return $this->query->with('roles')->get();
        }

        return User::with('roles')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Ad Soyad',
            'E-posta',
            'Telefon',
            'Durum',
            'Rol',
            'Son Giriş',
            'Oluşturulma Tarihi',
        ];
    }

    /**
     * @param mixed $user
     * @return array
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->phone,
            match ($user->status) {
                'active' => 'Aktif',
                'pending' => 'Beklemede',
                'passive' => 'Pasif',
                default => $user->status
            },
            $user->roles->pluck('name')->map(function ($role) {
                return match ($role) {
                    'super_admin' => 'Süper Admin',
                    'admin' => 'Admin',
                    'editor' => 'Editör',
                    'student' => 'Öğrenci',
                    default => $role
                };
            })->implode(', '),
            $user->last_login_at ? $user->last_login_at->format('d.m.Y H:i') : '-',
            $user->created_at->format('d.m.Y H:i'),
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }
}
