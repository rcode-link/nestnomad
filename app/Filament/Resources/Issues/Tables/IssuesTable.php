<?php

namespace App\Filament\Resources\Issues\Tables;

use App\Enums\IssueStatus;
use App\Filament\Resources\Issues\IssuesResource;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                SelectFilter::make('status')
                    ->default([IssueStatus::OPEN->value])
                    ->options(IssueStatus::getOptions())
                    ->multiple(),

            ])
            ->recordActions([
                Action::make('view')->icon(Heroicon::Eye)->color(Color::Gray)->url(fn($record) => IssuesResource::getUrl('view', ['record' => $record])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
