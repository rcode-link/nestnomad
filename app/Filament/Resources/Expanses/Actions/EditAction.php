<?php

namespace App\Filament\Resources\Expanses\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
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
                FileUpload::make('bill')->storeFile(false),
            ])
            ->visible(fn($record) => $record->lease()->propertyOwner()->count() > 0 && ! $record->is_paid)
            ->action(
                function ($data, $record): void {
                    $record->update([
                        'amount' => (int) ($data['amount'] * 100),
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
