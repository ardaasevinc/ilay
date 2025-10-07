<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Exports\PageExport;
use App\Filament\Resources\Pages\PageResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

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
                    return Excel::download(new PageExport(), 'sayfalar-' . now()->format('Y-m-d-H-i') . '.xlsx');
                }),
            Action::make('exportPdf')
                ->label('PDF İndir')
                ->icon('heroicon-o-document-text')
                ->color('danger')
                ->action(function () {
                    $pages = \App\Models\Page::all();
                    $pdf = Pdf::loadView('exports.pages-pdf', compact('pages'));
                    $pdf->setPaper('A4', 'landscape');
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, 'sayfalar-' . now()->format('Y-m-d-H-i') . '.pdf');
                }),
        ];
    }
}
