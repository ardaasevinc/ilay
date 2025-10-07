<?php

namespace App\Filament\Resources\EmailLogs\Pages;

use App\Filament\Resources\EmailLogs\EmailLogResource;
use App\Exports\EmailLogsExport;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class ListEmailLogs extends ListRecords
{
    protected static string $resource = EmailLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export')
                ->label('Excel\'e Aktar')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->visible(fn() => Auth::user()?->can('email_logs.export') ?? false)
                ->action(function () {
                    $query = $this->getFilteredTableQuery();
                    return Excel::download(
                        new EmailLogsExport($query),
                        'email-logs-' . now()->format('Y-m-d-H-i') . '.xlsx'
                    );
                }),
        ];
    }
}
