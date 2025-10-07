<?php

namespace App\Filament\Resources\References\Pages;

use App\Exports\ReferenceExport;
use App\Filament\Resources\References\ReferenceResource;
use App\Models\Reference;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListReferences extends ListRecords
{
    protected static string $resource = ReferenceResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Yeni Referans')
                ->icon('heroicon-o-plus')
                ->color('primary'),

            Action::make('exportExcel')
                ->label('Excel İndir')
                ->icon('heroicon-o-document-arrow-down')
                ->color('info')
                ->action(function () {
                    // Filtrelenmiş tablodan veri al
                    $query = $this->getFilteredTableQuery();
                    return Excel::download(new ReferenceExport($query), 'referanslar-' . now()->format('Y-m-d-H-i') . '.xlsx');
                }),

            Action::make('exportPdf')
                ->label('PDF İndir')
                ->icon('heroicon-o-document-text')
                ->color('danger')
                ->action(function () {
                    // Filtrelenmiş tablodan veri al
                    $query = $this->getFilteredTableQuery();
                    $references = $query->with('services')->get();
                    $pdf = Pdf::loadView('pdf.references', compact('references'));
                    $pdf->setPaper('A4', 'landscape');
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, 'referanslar-' . now()->format('Y-m-d-H-i') . '.pdf');
                }),
        ];
    }
}
