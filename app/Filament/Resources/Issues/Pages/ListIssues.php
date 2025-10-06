<?php

namespace App\Filament\Resources\Issues\Pages;

use App\Filament\Resources\Issues\IssuesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIssues extends ListRecords
{
    protected static string $resource = IssuesResource::class;

    public function getHeading(): string
    {
        return __('filament.issues.pages.list');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__('filament.issues.pages.create')),
        ];
    }
}
