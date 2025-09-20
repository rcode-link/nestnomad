<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Enums\ChargeCategory;
use App\Filament\Resources\Expanses\Actions\CreateAction;
use App\Filament\Resources\Expanses\Actions\ViewAction;
use App\Models\Expanse;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class ExpensesRelationManager extends RelationManager
{
    protected static string $relationship = 'expenses';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament.common.relations.charges');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament.charges.fields.description'))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {


        return $schema
            ->components([
                TextEntry::make('name'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->modifyQueryUsing(fn($query) => $query->whereHas('lease', fn($builder) => $builder->myLease()))
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.charges.fields.category'))
                    ->description(fn(Expanse $record) => $record->description)
                    ->formatStateUsing(fn(string $state): string => ChargeCategory::from($state)->getLabel())
                    ->color(fn(string $state): string => ChargeCategory::from($state)->getColor())
                    ->icon(fn(string $state): string => ChargeCategory::from($state)->getIcon()),

                TextColumn::make('amount')
                    ->label(__('filament.charges.fields.amount'))
                    ->money('EUR', divideBy: 100)
                    ->sortable(),
                TextColumn::make('payment.amount')
                    ->label(__('filament.charges.fields.amount'))
                    ->money('EUR', divideBy: 100, decimalPlaces: 2)
                    ->badge(),
                TextColumn::make('due_date')
                    ->label(__('filament.charges.fields.due_date'))
                    ->sortable()
                    ->date()
                    ->color(fn(string $state, $record) => ! $record->is_paid && Carbon::parse($state) < now() ? 'danger' : 'success'),
                IconColumn::make('is_paid')
                    ->label(__('filament.charges.fields.status'))
                    ->sortable()
                    ->icon(fn(string $state): Heroicon => $state ? Heroicon::CheckBadge : Heroicon::NoSymbol)
                    ->color(fn(string $state): string => $state ? 'success' : 'warning'),
            ])

            ->filters([
                SelectFilter::make('active_bills')
                    ->default('pending_payment')
                    ->options([
                        'pending_payment' => 'Pending Payment',
                        'pending_verification' => 'Pending Verification',
                    ])
                    ->query(
                        function ($data, Builder $query): Builder {
                            return match ($data['value']) {
                                'pending_payment' => $query->where('is_paid', false),
                                'pending_verification' => $query
                                    ->whereRaw('(amount = (select sum(payments.amount) from payments where expanse_id = expanses.id) and is_paid = false)'),
                                default => $query,
                            };
                        },
                    ),
            ])
            ->defaultSort('due_date')
            ->defaultGroup('lease.tenant_name')
            ->headerActions([
                CreateAction::make($this->ownerRecord),
            ])
            ->recordActions([
                Action::make('mark_paid')
                    ->color('success')
                    ->icon(Heroicon::CurrencyEuro)
                    ->requiresConfirmation()
                    ->visible($this->ownerRecord->query()->myProperty()->count() > 0)
                    ->fillForm(function (Expanse $record) {
                        $sum = Expanse::query()->whereId($record->id)->withSum('payment', 'amount')->first();
                        $paidAmount = (int) $sum->payment_sum_amount;

                        return [
                            'amount' => ($record->amount - $paidAmount) / 100,
                        ];
                    })
                    ->schema([
                        TextInput::make('amount')
                            ->numeric()
                            ->inputMode('decimal')
                            ->maxValue(function (Expanse $record) {
                                $sum = Expanse::query()->whereId($record->id)->withSum('payment', 'amount')->first();
                                $paidAmount = (int) $sum->payment_sum_amount;
                                return ($record->amount - $paidAmount) / 100;
                            })
                            ->step(0.01)
                        ,
                    ])
                    ->action(function (array $data, Expanse $record): void {
                        $record->payment()->create(['amount' => (int) ($data['amount'] * 100)]);
                        $sum = Expanse::query()->whereId($record->id)->withSum('payment', 'amount')->first();
                        $paidAmount = (int) $sum->payment_sum_amount;
                        $is_paid = $record->amount === $paidAmount && $record->query()->whereHas('lease', fn($query) => $query->propertyOwner())->count();
                        $record->update(['is_paid' => $is_paid]);
                    }),
                ViewAction::infolist(),
            ])
            ->toolbarActions([
            ]);
    }
}
