<?php

namespace App\Filament\Resources\Issues\Pages;

use App\Filament\Resources\Issues\IssuesResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIssues extends ViewRecord
{
    protected static string $resource = IssuesResource::class;

    public function getHeading(): string
    {
        return __('filament.issues.pages.view');
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
