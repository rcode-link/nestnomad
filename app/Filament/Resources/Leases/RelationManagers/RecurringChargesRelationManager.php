<?php

namespace App\Filament\Resources\Leases\RelationManagers;

use App\Enums\ChargeCategory;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class RecurringChargesRelationManager extends RelationManager
{
    protected static string $relationship = 'recurringCharges';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TimePicker::make('execute_at')
                    ->seconds(false)
                    ->native(false)
                    ->timezone("Europe/Belgrade")
                    ->required(),
                Select::make('title')
                    ->label(__('filament.charges.fields.category'))
                    ->options(ChargeCategory::getOptions())
                    ->default(ChargeCategory::RENT->value)
                    ->live()
                    ->required(),

                TextInput::make('description')
                    ->default(null),
                TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('interval')
                    ->options(['week' => 'Week', 'month' => 'Month'])
                    ->live()
                    ->required(),
                Select::make('interval_at')->options(range(1, 28))->visible(fn(Get $get) => 'month' === $get('interval'))->live(),
                Select::make('interval_at')->options(Carbon::getDays())->visible(fn(Get $get) => 'week' === $get('interval'))->live(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('interval'),
                TextColumn::make('interval_at')
                    ->searchable(),
                TextColumn::make('execute_at')

                    ->timezone("Europe/Belgrade")
                    ->time('H:i')
                    ->sortable(),
                TextColumn::make('title')
                    ->label(__('filament.charges.fields.category'))
                    ->formatStateUsing(fn(string $state): string => ChargeCategory::from($state)->getLabel())
                    ->color(fn(string $state): string => ChargeCategory::from($state)->getColor())
                    ->icon(fn(string $state): string => ChargeCategory::from($state)->getIcon()),
                TextColumn::make('description')
                    ->searchable(),
                TextColumn::make('amount')
                    ->money('EUR', divideBy: 100)
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
