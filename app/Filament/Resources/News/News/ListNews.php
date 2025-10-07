<?php

namespace App\Filament\Resources\News\News;

use App\Exports\NewsExport;
use App\Filament\Resources\News\NewsResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListNews extends ListRecords
{
    protected static string $resource = NewsResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
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
                    return Excel::download(new NewsExport(), 'bloglar-' . now()->format('Y-m-d-H-i') . '.xlsx');
                }),

            Action::make('exportPdf')
                ->label('PDF İndir')
                ->icon('heroicon-o-document-text')
                ->color('danger')
                ->action(function () {
                    $news = \App\Models\News::all();
                    $pdf = Pdf::loadView('exports.news-pdf', compact('news'));
                    $pdf->setPaper('A4', 'landscape');
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, 'bloglar-' . now()->format('Y-m-d-H-i') . '.pdf');
                }),
        ];
    }
}
