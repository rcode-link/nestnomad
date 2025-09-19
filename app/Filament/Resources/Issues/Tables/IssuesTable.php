<?php

namespace App\Filament\Resources\Issues\Tables;

use App\Enums\IssueStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class IssuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => IssueStatus::from($state)->getLabel())
                    ->color(fn(string $state): string => IssueStatus::from($state)->getColor())
                    ->icon(fn(string $state): string => IssueStatus::from($state)->getIcon()),
                TextColumn::make('user.name')
                    ->sortable(),
                TextColumn::make('property.name')
                    ->sortable(),
                TextColumn::make('created_at')->date()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([

            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
