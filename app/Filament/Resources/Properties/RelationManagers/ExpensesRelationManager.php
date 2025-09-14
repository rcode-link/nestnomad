<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Enums\ChargeCategory;
use App\Models\Expanse;
use App\Models\Lease;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
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
                Filter::make('active_bills')->default(true)
                    ->query(fn(Builder $query): Builder => $query->where('is_paid', false)),
            ])
            ->defaultSort('due_date')
            ->defaultGroup('lease.tenant_name')
            ->headerActions([
                Action::make('create')->schema([
                    Select::make('name')
                        ->label(__('filament.charges.fields.category'))
                        ->options(ChargeCategory::getOptions())
                        ->default(ChargeCategory::RENT->value)
                        ->live()
                        ->required(),
                    TextInput::make('description')
                        ->label(__('filament.charges.fields.description')),

                    TextInput::make('amount')
                        ->label(__('filament.charges.fields.amount'))
                        ->numeric()
                        ->step(0.01)
                        ->inputMode('decimal')
                        ->required(),
                    DatePicker::make('due_date')
                        ->label(__('filament.charges.fields.due_date'))
                        ->required(),
                    Checkbox::make('split_equally_to_leases')
                        ->default(true)
                        ->live()
                        ->translateLabel(),
                    Select::make('leases')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->hidden(fn($get) => $get('split_equally_to_leases'))
                        ->getOptionLabelsUsing(fn(array $values): array => Lease::query()
                            ->whereIn('id', $values)
                            ->pluck('tenant_name', 'id')
                            ->all())
                        ->getSearchResultsUsing(fn(string $search): array => Lease::query()
                            ->active()
                            ->where('tenant_name', 'like', "%{$search}%")
                            ->where('property_id', $this->ownerRecord->id)
                            ->limit(10)
                            ->pluck('tenant_name', 'id')
                            ->all()),
                    Checkbox::make('generate_pdf')
                        ->translateLabel(),
                    Checkbox::make('share_with_tenants')
                        ->default(true)
                        ->translateLabel(),
                    FileUpload::make('bill')->storeFile(false),
                ])->action(function ($data): void {
                    $amount = (int) ($data['amount'] * 100);
                    $per_lease_amount = $amount;
                    $leases = $data['leases'] ?? [];
                    if ($data['split_equally_to_leases']) {
                        $leases = Lease::query()
                            ->active()
                            ->where('property_id', $this->ownerRecord->id)->pluck('id');

                        $per_lease_amount = (int) ($amount / $leases->count());
                    }
                    $temporaryPath = null;
                    if ($data['bill']) {
                        $temporaryPath = $data['bill']->store('temp', 'public');
                        $originalName = $data['bill']->getClientOriginalName();
                    }
                    foreach ($leases as $lease) {
                        $model = Expanse::create([
                            'name' => $data['name'],
                            'lease_id' => $lease,
                            'amount' => $per_lease_amount,
                            'is_private' => ! $data['share_with_tenants'] ?? false,
                            'due_date' => $data['due_date'],
                            'description' => $data['description'],
                        ]);

                        if ($data['generate_pdf']) {
                            $model->generatePdf();
                        }


                        if ($temporaryPath) {
                            $model->addMediaFromDisk($temporaryPath, 'public')->usingFileName($originalName)->toMediaCollection('bill');
                        }
                    }
                }),
            ])
            ->recordActions([
                Action::make('mark_paid')
                    ->requiresConfirmation()
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
                            ->step(0.01)
                        ,
                    ])
                    ->action(function (array $data, Expanse $record): void {
                        $record->payment()->create(['amount' => (int) ($data['amount'] * 100)]);

                        $sum = Expanse::query()->whereId($record->id)->withSum('payment', 'amount')->first();
                        $paidAmount = (int) $sum->payment_sum_amount;
                        $record->update(['is_paid' => $record->amount === $paidAmount]);
                    }),
                Action::make('view_bill')
                    ->visible(fn(Expanse $record) => $record->getFirstMedia('bill'))
                    ->url(fn(Expanse $record) => $record->getFirstMedia('bill')->getTemporaryUrl(now()->addMinutes(5)))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
            ]);
    }

    private function showExpanseDescription(Get $get): bool
    {

        return collect([ChargeCategory::UTILITIES->value, ChargeCategory::OTHER->value])->filter(fn($value) => $value === $get('name'))->count() > 0;

    }
}
