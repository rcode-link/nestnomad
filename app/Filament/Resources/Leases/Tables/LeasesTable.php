<?php

namespace App\Filament\Resources\Leases\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class LeasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->groups([
                'property.name','user.tenant_name',
            ])
            ->modifyQueryUsing(fn($query) => $query->myLease())
            ->columns([
                TextColumn::make('property.name')
                    ->label(__('filament.leases.fields.property'))
                    ->sortable(),
                TextColumn::make('user.tenant_name')
                    ->label(__('filament.leases.fields.tenant'))
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
