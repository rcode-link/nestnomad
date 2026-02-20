<?php

namespace App\Filament\Resources\Leases\RelationManagers;

use App\Enums\ChargeCategory;
use App\Enums\DayOfWeek;
use App\Enums\UtilityType;
use App\Models\RecurringCharges;
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
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class RecurringChargesRelationManager extends RelationManager
{
    protected static string $relationship = 'recurringCharges';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('interval')
                    ->label(__('filament.recurring_charges.fields.interval'))
                    ->options([
                        'week' => __('filament.common.interval.week'),
                        'month' => __('filament.common.interval.month'),
                    ])
                    ->live()
                    ->required(),
                Select::make('interval_at')
                    ->label(__('filament.recurring_charges.fields.interval_at_month'))
                    ->options(collect(range(1, 28))->mapWithKeys(fn($str) => [$str => $str]))
                    ->visible(fn(Get $get) => 'month' === $get('interval'))
                    ->live(),
                Select::make('interval_at')
                    ->label(__('filament.recurring_charges.fields.interval_at_week'))
                    ->options(DayOfWeek::getOptions())
                    ->visible(fn(Get $get) => 'week' === $get('interval'))
                    ->live(),

                TimePicker::make('execute_at')
                    ->label(__('filament.recurring_charges.fields.execute_at'))
                    ->seconds(false)
                    ->native(false)
                    ->timezone("Europe/Belgrade")
                    ->required(),
                Select::make('title')
                    ->label(__('filament.charges.fields.category'))
                    ->options(ChargeCategory::getOptions())
                    ->default(ChargeCategory::RENT->value)
                    ->live()
                    ->columnSpanFull()
                    ->required(),
                Select::make('utility_type')
                    ->label(__('filament.charges.fields.utility_type'))
                    ->options(UtilityType::getOptions())
                    ->columnSpanFull()
                    ->visible(fn(Get $get) => $get('title') === ChargeCategory::UTILITIES->value)
                    ->required(fn(Get $get) => $get('title') === ChargeCategory::UTILITIES->value),
                TextInput::make('description')
                    ->label(__('filament.charges.fields.description'))
                    ->columnSpanFull()
                    ->hidden(fn(Get $get) => $get('title') === ChargeCategory::UTILITIES->value)
                    ->default(null),
                TextInput::make('amount')
                    ->label(__('filament.charges.fields.amount'))
                    ->numeric()
                    ->step(0.01)
                    ->inputMode('decimal')
                    ->required()
                    ->default(0),
                TextInput::make('due_date_in_days')
                    ->label(__('filament.recurring_charges.fields.due_date_in_days'))
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                Stack::make([

                    TextColumn::make('interval')
                        ->label(__('filament.recurring_charges.fields.interval')),
                    TextColumn::make('interval_at')
                        ->label(__('filament.recurring_charges.fields.interval_at'))
                        ->state(fn(RecurringCharges $record): string => 'week' === $record['interval'] ? DayOfWeek::from($record['interval_at'])->getLabel() : $record['interval_at'])
                        ->searchable(),
                    TextColumn::make('execute_at')
                        ->label(__('filament.recurring_charges.fields.execute_at'))
                        ->timezone("Europe/Belgrade")
                        ->time('H:i')
                        ->sortable(),
                    TextColumn::make('title')
                        ->label(__('filament.charges.fields.category'))
                        ->formatStateUsing(fn(string $state): string => ChargeCategory::from($state)->getLabel())
                        ->color(fn(string $state): string => ChargeCategory::from($state)->getColor())
                        ->icon(fn(string $state): string => ChargeCategory::from($state)->getIcon()),
                    TextColumn::make('description')
                        ->label(__('filament.charges.fields.description'))
                        ->searchable(),
                    TextColumn::make('amount')
                        ->label(__('filament.charges.fields.amount'))
                        ->money(fn(RecurringCharges $record): string => $record->lease?->currency?->value ?? 'EUR', divideBy: 100)
                        ->sortable(),
                    TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),

                ]),
            ])
            ->filters([

            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        if ($data['title'] === ChargeCategory::UTILITIES->value) {
                            $data['description'] = $data['utility_type'] ?? null;
                        }
                        unset($data['utility_type']);
                        $data['amount'] = (int) ($data['amount'] * 100);

                        return $data;
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->mutateRecordDataUsing(function (array $data): array {
                        if ($data['title'] === ChargeCategory::UTILITIES->value) {
                            $data['utility_type'] = $data['description'];
                        }
                        $data['amount'] = $data['amount'] / 100;

                        return $data;
                    })
                    ->mutateFormDataUsing(function (array $data): array {
                        if ($data['title'] === ChargeCategory::UTILITIES->value) {
                            $data['description'] = $data['utility_type'] ?? null;
                        }
                        unset($data['utility_type']);
                        $data['amount'] = (int) ($data['amount'] * 100);

                        return $data;
                    }),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
