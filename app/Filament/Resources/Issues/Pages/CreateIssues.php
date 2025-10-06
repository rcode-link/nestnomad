<?php

namespace App\Filament\Resources\Issues\Pages;

use App\Enums\IssueStatus;
use App\Filament\Resources\Issues\IssuesResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

final class CreateIssues extends CreateRecord
{
    protected static string $resource = IssuesResource::class;

    public function getHeading(): string
    {
        return __('filament.issues.pages.create');
    }

    protected function handleRecordCreation(array $data): Model
    {

        $data['status'] = IssueStatus::OPEN;
        $data['user_id'] = auth()->id();
        $model = static::getModel()::create($data);

        return $model;
    }
}
