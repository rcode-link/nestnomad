<?php

namespace App\Filament\Widgets;

use App\Models\Expanse;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

final class ThisMonthPayments extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => Expanse::query()
                ->whereHas('lease', fn($builder) => $builder->myLease()->with('media'))
                ->where('is_paid', false)
                ->orderBy('updated_at'))
            ->heading(__("Upcoming charges"))
            ->defaultGroup('lease.tenant_name')
            ->columns([
                TextColumn::make('amount')
                    ->label(__('filament.charges.fields.amount'))
                    ->money('BAM', divideBy: 100, decimalPlaces: 2),
                TextColumn::make('due_date')
                    ->label(__('filament.charges.fields.due_date'))
                    ->sortable()
                    ->date()
                    ->color(fn(string $state, $record) => ! $record->is_paid && Carbon::parse($state) < now() ? 'danger' : 'success'),
            ])
            ->filters([

            ])
            ->headerActions([

            ])
            ->recordActions([

            ])
            ->toolbarActions([
                BulkActionGroup::make([

                ]),
            ]);
    }

}
