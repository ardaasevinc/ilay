<?php

namespace App\Filament\Resources\Subscriptions\Pages;

use App\Filament\Resources\Subscriptions\SubscriptionResource;
use App\Models\Subscription;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSubscriptions extends ListRecords
{
    protected static string $resource = SubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Yeni Abonelik')
                ->color('primary'),
            Action::make('exportPdf')
                ->label('PDF İndir')
                ->icon('heroicon-o-document-arrow-down')
                ->color('info')
                ->action(function () {
                    $subscriptions = Subscription::orderBy('created_at', 'desc')->get();
                    $pdf = PDF::loadView('admin.exports.subscriptions-pdf', compact('subscriptions'))
                        ->setPaper('a4', 'portrait');

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, 'abonelikler-' . now()->format('Y-m-d-H-i') . '.pdf');
                }),
        ];
    }
}
