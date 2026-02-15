<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\DetachAction;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

final class ManagersRelationManager extends RelationManager
{
    protected static string $relationship = 'managers';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament.common.relations.managers');
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.managers.fields.name'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('filament.managers.fields.email'))
                    ->searchable(),
            ])
            ->headerActions([
                Action::make('addManager')
                    ->label(__('filament.managers.actions.add'))
                    ->form([
                        Select::make('user_id')
                            ->label(__('filament.managers.fields.email'))
                            ->searchable()
                            ->getSearchResultsUsing(fn (string $search): array =>
                                User::where('email', 'like', "%{$search}%")
                                    ->whereNotIn('id', $this->ownerRecord->users()->pluck('users.id'))
                                    ->limit(10)
                                    ->pluck('email', 'id')
                                    ->toArray()
                            )
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        $this->ownerRecord->users()->attach($data['user_id'], ['role' => 'manager']);
                    })
                    ->visible(fn (): bool => auth()->user()->isOwnerOf($this->ownerRecord)),
            ])
            ->recordActions([
                DetachAction::make()
                    ->label(__('filament.managers.actions.remove'))
                    ->visible(fn (): bool => auth()->user()->isOwnerOf($this->ownerRecord)),
            ]);
    }
}
