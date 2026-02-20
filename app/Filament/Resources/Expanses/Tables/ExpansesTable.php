<?php

namespace App\Filament\Resources\Expanses\Tables;

use App\Enums\ChargeCategory;
use App\Enums\UtilityType;
use App\Filament\Resources\Expanses\Actions\EditAction;
use App\Filament\Resources\Expanses\Actions\ViewAction;
use App\Models\Expanse;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

final class ExpansesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->groups([
                Group::make('lease_month')
                    ->label(__('filament.charges.fields.tenant'))
                    ->getTitleFromRecordUsing(fn(Expanse $record): string => Carbon::parse($record->due_date)->format('F Y'))
                    ->groupQueryUsing(fn(Builder $builder) => $builder->groupBy(fn(Builder $group) => Carbon::parse($group->due_date)->format('Y_m')))
                    ->orderQueryUsing(fn($query) => $query->orderBy('due_date', 'desc'))
                    ->titlePrefixedWithLabel(false)
                    ->collapsible(),
            ])
            ->defaultGroup('lease_month')
            ->modifyQueryUsing(fn($query) => $query
                ->withSum('payment', 'amount')
                ->with('lease.user')
                ->whereHas('lease', fn($builder) => $builder->myLease()))
            ->extraAttributes(function (): array {
                $allPaidGroups = Expanse::query()
                    ->whereHas('lease', fn($builder) => $builder->myLease())
                    ->get()
                    ->groupBy(fn(Expanse $e): string => Carbon::parse($e->due_date)->format('F Y'))
                    ->filter(fn($group): bool => $group->every(fn(Expanse $e): bool => $e->is_paid))
                    ->keys()
                    ->values()
                    ->toArray();

                return ['x-init' => 'collapsedGroups = ' . json_encode($allPaidGroups)];
            })
            ->columns([
                Split::make([
                    IconColumn::make('is_paid')
                        ->label(__('filament.charges.fields.status'))
                        ->grow(false)
                        ->icon(fn(string $state): Heroicon => $state ? Heroicon::CheckBadge : Heroicon::NoSymbol)
                        ->color(fn(string $state): string => $state ? 'success' : 'warning'),

                    TextColumn::make('due_date')
                        ->label(__('filament.charges.fields.due_date'))
                        ->date('d M')
                        ->grow(false)
                        ->color(fn(string $state, $record) => ! $record->is_paid && Carbon::parse($state) < now() ? 'danger' : 'gray'),

                    TextColumn::make('name')
                        ->label(__('filament.charges.fields.category'))
                        ->formatStateUsing(function (string $state, Expanse $record): string {
                            $label = ChargeCategory::from($state)->getLabel();
                            if ( ! $record->description) {
                                return $label;
                            }
                            $detail = $state === ChargeCategory::UTILITIES->value
                                ? (UtilityType::tryFrom($record->description)?->getLabel() ?? $record->description)
                                : $record->description;

                            return $label . ' · ' . $detail;
                        })
                        ->color(fn(string $state): string => ChargeCategory::from($state)->getColor())
                        ->icon(fn(string $state): string => ChargeCategory::from($state)->getIcon()),

                    Stack::make([
                        TextColumn::make('amount')
                            ->label(__('filament.charges.fields.amount'))
                            ->money(fn(Expanse $record): string => $record->lease?->currency?->value ?? 'EUR', divideBy: 100, decimalPlaces: 2)
                            ->extraAttributes(['class' => 'hidden md:block'])
                            ->alignEnd(),

                        TextColumn::make('remaining_balance')
                            ->label(__('filament.charges.fields.remaining_balance'))
                            ->state(fn(Expanse $record): int => $record->amount - (int) $record->payment_sum_amount)
                            ->money(fn(Expanse $record): string => $record->lease?->currency?->value ?? 'EUR', divideBy: 100, decimalPlaces: 2)
                            ->color(fn(Expanse $record): string => ($record->amount - (int) $record->payment_sum_amount) > 0 ? 'danger' : 'success')
                            ->alignEnd(),
                    ])->grow(false)->alignEnd(),
                ])->extraAttributes(['class' => 'flex-nowrap items-center']),
            ])
            ->filters([
                SelectFilter::make('active_bills')
                    ->default('pending_payment')
                    ->options([
                        'pending_payment' => __('filament.charges.status.pending_payment'),
                        'pending_verification' => __('filament.charges.status.pending_verification'),
                        'needs_attention' => __('filament.charges.status.needs_attention'),
                    ])
                    ->query(
                        function ($data, Builder $query): Builder {
                            return match ($data['value']) {
                                'pending_payment' => $query->where('is_paid', false),
                                'pending_verification' => $query->pendingVerification(),
                                'needs_attention' => $query->where('amount', 0),
                                default => $query,
                            };
                        },
                    ),
            ])
            ->defaultSort('due_date', 'desc')
            ->recordAction('view')
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    Action::make('mark_paid')
                        ->label(__('filament.charges.actions.mark_paid'))
                        ->color('success')
                        ->icon(Heroicon::CurrencyEuro)
                        ->requiresConfirmation()
                        ->fillForm(function (Expanse $record) {
                            $paidAmount = (int) $record->payment_sum_amount;

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
                                ->step(0.01),
                            FileUpload::make('receipt')->storeFile(false),
                        ])
                        ->visible(function (Expanse $expanse) {
                            $paidAmount = (int) $expanse->payment_sum_amount;

                            if ($expanse->amount === $paidAmount) {
                                return false;
                            }

                            return ! $expanse->is_paid;
                        })
                        ->action(function (array $data, Expanse $record): void {
                            $model = $record->payment()->create(['amount' => (int) ($data['amount'] * 100)]);
                            $paidAmount = (int) $record->payment_sum_amount;
                            $is_paid = $record->amount === $paidAmount && $record->query()->whereHas('lease', fn($query) => $query->propertyOwner())->count();
                            $record->update(['is_paid' => $is_paid]);
                            $temporaryPath = null;
                            if ($data['receipt']) {
                                $temporaryPath = $data['receipt']->store('temp', 'public');
                                $originalName = $data['receipt']->getClientOriginalName();
                            }
                            if ($temporaryPath) {
                                $model->addMediaFromDisk($temporaryPath, 'public')->preservingOriginal()->usingFileName($originalName)->toMediaCollection('receipt', 's3');
                                Storage::delete($temporaryPath);
                            }
                        }),
                    (new ViewAction())->infolist(),
                ])->extraAttributes(['class' => 'md:flex hidden']),
            ])
            ->toolbarActions([
            ]);
    }
}
