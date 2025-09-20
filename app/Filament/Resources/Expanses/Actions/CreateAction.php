<?php

namespace App\Filament\Resources\Expanses\Actions;

use App\Enums\ChargeCategory;
use App\Models\Expanse;
use App\Models\Lease;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

final class CreateAction
{
    public static function make($record): Action
    {
        return Action::make('create')->schema([
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
                    ->where('property_id', $record->id)
                    ->limit(10)
                    ->pluck('tenant_name', 'id')
                    ->all()),
            Checkbox::make('generate_pdf')
                ->translateLabel(),
            Checkbox::make('share_with_tenants')
                ->default(true)
                ->translateLabel(),
            FileUpload::make('bill')->storeFile(false),
        ])
            ->visible($record->query()->myProperty()->count() > 0)
            ->action(function ($data) use ($record): void {
                $amount = (int) ($data['amount'] * 100);
                $per_lease_amount = $amount;
                $leases = $data['leases'] ?? [];
                if ($data['split_equally_to_leases']) {
                    $leases = Lease::query()
                        ->active()
                        ->where('property_id', $record->id)->pluck('id');

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
                        $model->addMediaFromDisk($temporaryPath, 'public')->usingFileName($originalName)->toMediaCollection('bill', 's3');
                    }
                }
            });
    }

}
