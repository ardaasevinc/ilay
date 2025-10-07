<?php

namespace App\Filament\Resources\Users\Pages;

use App\Exports\UsersExport;
use App\Filament\Resources\Users\UserResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),

            Action::make('exportExcel')
                ->label('Excel İndir')
                ->icon('heroicon-o-document-arrow-down')
                ->color('light-info')
                ->action(function () {
                    return Excel::download(new UsersExport(), 'kullanicilar-' . now()->format('Y-m-d-H-i') . '.xlsx');
                }),

            Action::make('exportPdf')
                ->label('PDF İndir')
                ->icon('heroicon-o-document-text')
                ->color('danger')
                ->action(function () {
                    $users = \App\Models\User::with('roles')->get();

                    $pdf = Pdf::loadView('exports.users-pdf', compact('users'));
                    $pdf->setPaper('A4', 'landscape');

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, 'kullanicilar-' . now()->format('Y-m-d-H-i') . '.pdf');
                }),
        ];
    }
}
