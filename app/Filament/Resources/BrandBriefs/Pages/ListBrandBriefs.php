<?php

namespace App\Filament\Resources\BrandBriefs\Pages;

use App\Filament\Resources\BrandBriefs\BrandBriefResource;
use App\Models\BrandBrief;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;

use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListBrandBriefs extends ListRecords
{
    protected static string $resource = BrandBriefResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Yeni Marka Analizi')
                ->color('primary'),
            Action::make('exportPdf')
                ->label('PDF İndir')
                ->icon('heroicon-o-document-arrow-down')
                ->color('info')
                ->action(function () {
                    $brandBriefs = BrandBrief::with([])->get();
                    $pdf = PDF::loadView('admin.exports.brand-briefs-pdf', compact('brandBriefs'))
                        ->setPaper('a4', 'landscape');

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, 'marka-analizleri-' . now()->format('Y-m-d-H-i') . '.pdf');
                }),
        ];
    }
}
