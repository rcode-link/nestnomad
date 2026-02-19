<?php

namespace App\Filament\Resources\Expanses\Actions;

use App\Enums\ChargeCategory;
use Carbon\Carbon;
use App\Enums\UtilityType;
use App\Filament\Resources\Expanses\Actions\EditAction as ExpanseEditAction;
use App\Models\Expanse;
use App\Models\Payment;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

final class ViewAction
{
    private $action;
    public function infolist(): Action
    {
        $this->action = Action::make("view")
            ->label(__('filament.common.actions.view'))
            ->icon(Heroicon::Eye)
            ->modalSubmitAction(false)
            ->extraModalFooterActions([
                ExpanseEditAction::make(),
                Action::make("MarkPaid")
                    ->label(__('filament.charges.actions.mark_paid'))
                    ->visible(fn(Expanse $expanse) => $expanse->lease()->propertyOwner()->count() > 0 && ! $expanse->is_paid)
                    ->requiresConfirmation()
                    ->action(function (Expanse $record): void {

                        $sum = Expanse::query()->whereId($record->id)->withSum('payment', 'amount')->first();
                        $paidAmount = (int) $sum->payment_sum_amount;
                        $amount = $record->amount - $paidAmount;

                        if ($amount > 0) {
                            $record->payment()->create(['amount' => $amount]);
                        }

                        $record->update(['is_paid' => true]);

                    }),
            ])
            ->schema([
                Grid::make(3)
                    ->schema([
                        TextEntry::make('name')
                            ->label(__('filament.charges.fields.category'))
                            ->formatStateUsing(fn(string $state): string => ChargeCategory::from($state)->getLabel())
                            ->icon(fn(Expanse $record): string => ChargeCategory::from($record->name)->getIcon())
                            ->color(fn(Expanse $record): string => ChargeCategory::from($record->name)->getColor()),

                        TextEntry::make('due_date')
                            ->label(__('filament.charges.fields.due_date'))
                            ->date('d M Y')
                            ->color(fn(Expanse $record): string => ! $record->is_paid && Carbon::parse($record->due_date)->isPast() ? 'danger' : 'gray'),

                        TextEntry::make('is_paid')
                            ->label(__('filament.charges.fields.status'))
                            ->formatStateUsing(fn(bool $state): string => $state ? __('filament.charges.status.paid') : __('filament.charges.status.pending'))
                            ->icon(fn(bool $state): Heroicon => $state ? Heroicon::CheckBadge : Heroicon::Clock)
                            ->color(fn(bool $state): string => $state ? 'success' : 'warning'),

                        TextEntry::make('description')
                            ->label(__('filament.charges.fields.description'))
                            ->formatStateUsing(fn(?string $state, Expanse $record): string => $record->name === ChargeCategory::UTILITIES->value && $state
                                ? (UtilityType::tryFrom($state)?->getLabel() ?? $state)
                                : ($state ?? '—'))
                            ->columnSpanFull()
                            ->hidden(fn(Expanse $record): bool => blank($record->description)),
                    ]),

                Grid::make(2)
                    ->schema([
                        TextEntry::make('amount')
                            ->money('EUR', divideBy: 100)
                            ->label(__('charges.Bill'))
                            ->size(TextSize::Large)
                            ->icon(Heroicon::Link)
                            ->color(fn(Expanse $record) => null !== $record->getFirstMedia('bill') ? "info" : 'danger')
                            ->iconColor(fn(Expanse $record) => null !== $record->getFirstMedia('bill') ? "info" : 'danger')
                            ->disabled(fn(Expanse $record) => null !== $record->getFirstMedia('bill'))
                            ->url(fn(Expanse $record) => $record->getFirstMedia('bill')?->getTemporaryUrl(now()->addMinutes(5)))
                            ->openUrlInNewTab(),
                        TextEntry::make('remaining_bill')
                            ->money('EUR', divideBy: 100)
                            ->size(TextSize::Large)
                            ->weight(FontWeight::Bold)
                            ->default(
                                function (Expanse $record) {
                                    $sum = Expanse::query()->whereId($record->id)->withSum('payment', 'amount')->first();
                                    $paidAmount = (int) $sum->payment_sum_amount;

                                    return ($record->amount - $paidAmount);
                                },
                            )
                            ->label(__('charges.RemainingBill')),



                        RepeatableEntry::make('payment')
                            ->label(__('charges.payment'))
                            ->schema([
                                TextEntry::make('amount')
                                    ->hiddenLabel()
                                    ->weight(FontWeight::Bold)
                                    ->money('EUR', divideBy: 100, decimalPlaces: 2),
                                TextEntry::make('created_at')
                                    ->hiddenLabel()
                                    ->date('d M Y')
                                    ->size(TextSize::Small)
                                    ->color('gray'),
                                IconEntry::make('amount')
                                    ->hiddenLabel()
                                    ->alignEnd()
                                    ->icon(Heroicon::Link)
                                    ->color('info')
                                    ->url(fn(Payment $record) => $record->getFirstMedia('receipt')?->getTemporaryUrl(now()->addMinutes(5)))
                                    ->openUrlInNewTab()
                                    ->visible(fn(Payment $record) => null !== $record->getFirstMedia('receipt')),
                                Action::make("addReceipt")
                                    ->label(__('filament.charges.actions.add_receipt'))
                                    ->size('sm')
                                    ->extraAttributes(['style' => 'display:block;width:fit-content;margin-left:auto'])
                                    ->schema([
                                        FileUpload::make('receipt')->storeFile(false)->acceptedFileTypes(['image/*', 'application/pdf']),
                                    ])
                                    ->visible(fn(Payment $record) => null === $record->getFirstMedia('receipt'))
                                    ->action(function ($data, Payment $record, $livewire): void {
                                        $temporaryPath = null;
                                        if ($data['receipt']) {
                                            $temporaryPath = $data['receipt']->store('temp', 'public');
                                            $originalName = $data['receipt']->getClientOriginalName();
                                        }
                                        if ($temporaryPath) {
                                            $record->addMediaFromDisk($temporaryPath, 'public')->preservingOriginal()->usingFileName($originalName)->toMediaCollection('receipt', 's3');
                                            Storage::delete($temporaryPath);
                                        }
                                    })->after(function (Component $livewire): void {
                                        $livewire->dispatch('refreshReceipts');
                                    }),
                            ])
                            ->columns(['default' => 3])
                            ->contained(false)
                            ->extraAttributes([])
                            ->columnSpanFull(),
                    ]),
            ])
            ->slideOver(true);

        return $this->action;
    }
}
