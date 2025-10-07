<?php

namespace App\Filament\Resources\NewsCategories\NewsCategories;

use App\Exports\NewsCategoryExport;
use App\Filament\Resources\NewsCategories\NewsCategoryResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListNewsCategories extends ListRecords
{
    protected static string $resource = NewsCategoryResource::class;

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
                    return Excel::download(new NewsCategoryExport(), 'blog-kategorileri-' . now()->format('Y-m-d-H-i') . '.xlsx');
                }),
            Action::make('exportPdf')
                ->label('PDF İndir')
                ->icon('heroicon-o-document-text')
                ->color('danger')
                ->action(function () {
                    $categories = \App\Models\NewsCategory::all();
                    $pdf = Pdf::loadView('exports.news-categories-pdf', compact('categories'));
                    $pdf->setPaper('A4', 'landscape');
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, 'blog-kategorileri-' . now()->format('Y-m-d-H-i') . '.pdf');
                }),
        ];
    }
}
