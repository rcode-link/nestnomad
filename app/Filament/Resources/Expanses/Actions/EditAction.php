<?php

namespace App\Filament\Resources\Expanses\Actions;

use App\Enums\ChargeCategory;
use App\Enums\UtilityType;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Storage;

final class EditAction
{
    public static function make(): Action
    {
        return Action::make('edit')
            ->icon(Heroicon::PencilSquare)
            ->schema([
                TextInput::make('amount')
                    ->label(__('filament.charges.fields.amount'))
                    ->default(fn($record) => $record->amount / 100)
                    ->numeric()
                    ->step(0.01)
                    ->inputMode('decimal')
                    ->required(),
                Select::make('utility_type')
                    ->label(__('filament.charges.fields.utility_type'))
                    ->options(UtilityType::getOptions())
                    ->default(fn($record) => $record->name === ChargeCategory::UTILITIES->value ? $record->description : null)
                    ->visible(fn($record) => $record?->name === ChargeCategory::UTILITIES->value),
                FileUpload::make('bill')->storeFile(false),
            ])
            ->visible(fn($record) => $record->lease()->propertyOwner()->count() > 0 && ! $record->is_paid)
            ->action(
                function ($data, $record): void {
                    $record->update([
                        'amount' => (int) ($data['amount'] * 100),
                        'description' => $record->name === ChargeCategory::UTILITIES->value
                            ? ($data['utility_type'] ?? $record->description)
                            : $record->description,
                    ]);
                    $temporaryPath = null;
                    if ($data['bill']) {
                        $temporaryPath = $data['bill']->store('temp', 'public');
                        $originalName = $data['bill']->getClientOriginalName();
                    }
                    if ($temporaryPath) {
                        $record->addMediaFromDisk($temporaryPath, 'public')
                            ->preservingOriginal()
                            ->usingFileName($originalName)
                            ->toMediaCollection('bill', 's3');
                        Storage::delete($temporaryPath);
                    }
                },
            );
    }
}
