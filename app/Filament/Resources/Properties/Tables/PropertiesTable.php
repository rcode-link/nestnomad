<?php

namespace App\Filament\Resources\Properties\Tables;

use App\Models\Property;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn($query) => $query->with('users')->iCanAccess())
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                Stack::make([TextColumn::make('name')
                    ->label(__('filament.properties.fields.name'))
                    ->description(fn(Property $record): string => $record->address['placeName'])
                    ->sortable(),
                    TextColumn::make('lease.user.tenant_name')
                        ->label(__('filament.common.relations.tenants'))
                        ->badge()
                        ->separator(', '),]),
            ])
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
