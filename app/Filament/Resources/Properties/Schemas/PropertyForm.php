<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Filament\Forms\Components\MapboxSearch;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament.properties.fields.name'))
                    ->required()
                    ->columnSpanFull(),
                Checkbox::make('public')
                    ->label(__('filament.properties.fields.public')),
                MapboxSearch::make('address')
                    ->label(__('filament.properties.fields.address'))
                    ->required(),
            ]);
    }
}
