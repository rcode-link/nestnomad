<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Filament\Forms\Components\MapboxSearch;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->columnSpanFull(),
                MapboxSearch::make('address')->required(),
            ]);
    }
}
