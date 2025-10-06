<?php

namespace App\Filament\Resources\Expanses\Tables;

use App\Enums\ChargeCategory;
use App\Filament\Resources\Expanses\Actions\ViewAction;
use App\Models\Expanse;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
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
//            ->groups([
//                Group::make('lease.user.tenant_name'),
//                Group::make('due_date')
//                    ->label(__('filament.charges.fields.due_date')),
//
//            ])
            ->modifyQueryUsing(fn($query) => $query->withSum('payment', 'amount')
                ->whereHas('lease', fn($builder) => $builder->myLease()->with('user')))
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.charges.fields.category'))
                    ->description(fn(Expanse $record) => $record->description)
                    ->formatStateUsing(fn(string $state): string => ChargeCategory::from($state)->getLabel())
                    ->color(fn(string $state): string => ChargeCategory::from($state)->getColor())
                    ->icon(fn(string $state): string => ChargeCategory::from($state)->getIcon()),

                TextColumn::make('lease.user.tenant_name')->label(__('filament.charges.fields.tenant'))->searchable(),
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
                                'pending_verification' => $query->pendingVerification(),
                                default => $query,
                            };
                        },
                    ),
            ])
            ->defaultSort('due_date')
            ->recordActions([
                Action::make('mark_paid')
                    ->color('success')
                    ->icon(Heroicon::CurrencyEuro)
                    ->requiresConfirmation()
//                    ->visible($this->ownerRecord->query()->myProperty()->count() > 0)
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
            ])
            ->toolbarActions([
            ]);
    }
}
