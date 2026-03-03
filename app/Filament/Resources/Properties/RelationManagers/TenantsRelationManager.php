<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

final class TenantsRelationManager extends RelationManager
{
    protected static string $relationship = 'lease';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament.common.relations.tenants');
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('tenant_name')
            ->columns([
                TextColumn::make('user.tenant_name')
                    ->label(__('filament.tenants.fields.first_name'))
                    ->badge()
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label(__('filament.tenants.fields.email'))
                    ->placeholder('-'),
                TextColumn::make('user.phone')
                    ->label(__('filament.profile.phone'))
                    ->placeholder('-'),
                TextColumn::make('start_of_lease')
                    ->label(__('filament.leases.fields.start_date'))
                    ->date(),
                TextColumn::make('end_of_lease')
                    ->label(__('filament.leases.fields.end_date'))
                    ->date()
                    ->placeholder('-'),
            ])
            ->filters([

            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
