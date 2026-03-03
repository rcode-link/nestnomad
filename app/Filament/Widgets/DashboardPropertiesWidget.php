<?php

namespace App\Filament\Widgets;

use App\Enums\IssueStatus;
use App\Filament\Resources\Properties\PropertyResource;
use App\Models\Property;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

final class DashboardPropertiesWidget extends TableWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => Property::query()
                    ->iCanAccess()
                    ->withCount([
                        'issues' => fn (Builder $query) => $query->where('status', '!=', IssueStatus::DONE),
                        'expenses' => fn (Builder $query) => $query->where('is_paid', false),
                    ])
                    ->with('lease.user'),
            )
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.properties.fields.name'))
                    ->url(fn (Property $record): string => PropertyResource::getUrl('view', ['record' => $record]))
                    ->searchable(),

                TextColumn::make('lease.user.tenant_name')
                    ->label(__('filament.common.relations.tenants'))
                    ->badge(),

                TextColumn::make('issues_count')
                    ->label(__('common.Issues'))
                    ->badge()
                    ->color(fn (int $state): string => $state > 0 ? 'danger' : 'success'),

                TextColumn::make('expenses_count')
                    ->label(__('filament.common.relations.charges'))
                    ->badge()
                    ->color(fn (int $state): string => $state > 0 ? 'warning' : 'success'),
            ]);
    }
}
