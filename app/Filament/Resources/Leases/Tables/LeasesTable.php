<?php

namespace App\Filament\Resources\Leases\Tables;

use App\Models\Lease;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

final class LeasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->groups([
                'property.name',
                Group::make('user.tenant_name')
                    ->label(__('filament.leases.fields.tenant'))
                    ->getKeyFromRecordUsing(
                        fn(Lease $record): string => $record->user
                            ->pluck('tenant_name')
                            ->filter()
                            ->sort()
                            ->join(', ')
                    )
                    ->getTitleFromRecordUsing(
                        fn(Lease $record): string => $record->user
                            ->pluck('tenant_name')
                            ->filter()
                            ->join(', ')
                    ),
            ])
            ->modifyQueryUsing(fn($query) => $query->myLease()->with('user'))
            ->columns([
                TextColumn::make('property.name')
                    ->label(__('filament.leases.fields.property'))
                    ->sortable(),
                TextColumn::make('user.tenant_name')
                    ->label(__('filament.leases.fields.tenant'))
                    ->badge()
                    ->separator(', ')
                    ->searchable(),
                TextColumn::make('start_of_lease')
                    ->label(__('filament.leases.fields.start_date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('end_of_lease')
                    ->label(__('filament.leases.fields.end_date'))
                    ->date()
                    ->sortable(),
            ])
            ->filters([

            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
