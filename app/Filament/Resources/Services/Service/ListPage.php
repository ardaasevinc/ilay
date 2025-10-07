<?php

namespace App\Filament\Resources\Services\Service;

use App\Exports\ServiceExport;
use App\Filament\Resources\Services\ServiceResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListPage extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->color('primary'),
            Action::make('exportExcel')
                ->label('Excel İndir')
                ->icon('heroicon-o-document-arrow-down')
                ->color('info')
                ->action(function () {
                    return Excel::download(new ServiceExport(), 'hizmetler-' . now()->format('Y-m-d-H-i') . '.xlsx');
                }),
            Action::make('exportPdf')
                ->label('PDF İndir')
                ->icon('heroicon-o-document-text')
                ->color('danger')
                ->action(function () {
                    $services = \App\Models\Service::with('service_category')->get();
                    $pdf = Pdf::loadView('exports.services-pdf', compact('services'));
                    $pdf->setPaper('A4', 'landscape');
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, 'hizmetler-' . now()->format('Y-m-d-H-i') . '.pdf');
                }),
        ];
    }
}
