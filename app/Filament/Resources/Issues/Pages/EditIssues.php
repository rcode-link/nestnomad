<?php

namespace App\Filament\Resources\Issues\Pages;

use App\Filament\Resources\Issues\IssuesResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditIssues extends EditRecord
{
    protected static string $resource = IssuesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
