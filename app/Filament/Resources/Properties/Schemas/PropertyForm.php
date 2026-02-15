<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Filament\Forms\Components\MapboxSearch;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
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

                Fieldset::make(__('filament.properties.sections.details'))
                    ->schema([
                        TextInput::make('floor')
                            ->label(__('filament.properties.fields.floor'))
                            ->numeric()
                            ->minValue(0),
                        TextInput::make('size')
                            ->label(__('filament.properties.fields.size'))
                            ->numeric()
                            ->minValue(0)
                            ->suffix('m²'),
                        TextInput::make('rooms')
                            ->label(__('filament.properties.fields.rooms'))
                            ->numeric()
                            ->minValue(0),
                        TextInput::make('bathrooms')
                            ->label(__('filament.properties.fields.bathrooms'))
                            ->numeric()
                            ->minValue(0),
                        Select::make('heating')
                            ->label(__('filament.properties.fields.heating'))
                            ->options([
                                'central' => __('filament.properties.heating.central'),
                                'gas' => __('filament.properties.heating.gas'),
                                'electric' => __('filament.properties.heating.electric'),
                                'wood' => __('filament.properties.heating.wood'),
                                'heat_pump' => __('filament.properties.heating.heat_pump'),
                            ]),
                        TextInput::make('year_built')
                            ->label(__('filament.properties.fields.year_built'))
                            ->numeric()
                            ->minValue(1800)
                            ->maxValue(date('Y')),
                    ])->columns(3),

                Fieldset::make(__('filament.properties.sections.amenities'))
                    ->schema([
                        Checkbox::make('furnished')
                            ->label(__('filament.properties.fields.furnished')),
                        Checkbox::make('parking')
                            ->label(__('filament.properties.fields.parking')),
                        Checkbox::make('elevator')
                            ->label(__('filament.properties.fields.elevator')),
                        Checkbox::make('balcony')
                            ->label(__('filament.properties.fields.balcony')),
                    ])->columns(4),

                Textarea::make('description')
                    ->label(__('filament.properties.fields.description'))
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
