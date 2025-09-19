<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Enums\IssueStatus;
use App\Filament\Resources\Issues\IssuesResource;
use App\Filament\Resources\Issues\Schemas\IssuesForm;
use App\Models\Issues;
use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

final class IssuesRelationManager extends RelationManager
{
    protected static string $relationship = 'issues';

    protected static ?string $relatedResource = IssuesResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('create')->translateLabel()
                    ->schema(IssuesForm::schema($this->ownerRecord->id))
                    ->action(function ($data): void {
                        $data['status'] = IssueStatus::OPEN;
                        $data['user_id'] = auth()->id();
                        $data['property_id'] = $this->ownerRecord->id;
                        Issues::create($data);
                    }),
            ]);
    }
}
