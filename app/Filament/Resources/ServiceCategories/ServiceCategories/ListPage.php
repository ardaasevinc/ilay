<?php

namespace App\Filament\Resources\ServiceCategories\ServiceCategories;

use App\Exports\ServiceCategoryExport;
use App\Filament\Resources\ServiceCategories\ServiceCategoryResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListPage extends ListRecords
{
    protected static string $resource = ServiceCategoryResource::class;

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
                    return Excel::download(new ServiceCategoryExport(), 'hizmet-kategorileri-' . now()->format('Y-m-d-H-i') . '.xlsx');
                }),
            Action::make('exportPdf')
                ->label('PDF İndir')
                ->icon('heroicon-o-document-text')
                ->color('danger')
                ->action(function () {
                    $categories = \App\Models\ServiceCategory::all();
                    $pdf = Pdf::loadView('exports.service-categories-pdf', compact('categories'));
                    $pdf->setPaper('A4', 'landscape');
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, 'hizmet-kategorileri-' . now()->format('Y-m-d-H-i') . '.pdf');
                }),
        ];
    }
}
