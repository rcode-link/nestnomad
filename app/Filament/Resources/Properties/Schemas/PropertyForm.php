<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Filament\Forms\Components\MapboxSearch;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

final class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('name')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),
                MapboxSearch::make('address'),
            ]);
    }
}
