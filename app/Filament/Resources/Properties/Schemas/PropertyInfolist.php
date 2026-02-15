<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Filament\Infolists\Components\MaxBoxEntery;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class PropertyInfolist
{
    public static function tenantRow(): array
    {
        return [];
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make()
                        ->schema([
                            TextEntry::make('name'),
                            TextEntry::make('address.placeName'),
                        ]),
                ])->from('md'),
                Flex::make([
                    Section::make()
                        ->schema([
                            MaxBoxEntery::make('address'),
                        ]),
                ])->from('md')->verticallyAlignCenter(),

                Section::make(__('filament.properties.sections.details'))
                    ->schema([
                        TextEntry::make('floor')
                            ->label(__('filament.properties.fields.floor')),
                        TextEntry::make('size')
                            ->label(__('filament.properties.fields.size'))
                            ->suffix(' m²'),
                        TextEntry::make('rooms')
                            ->label(__('filament.properties.fields.rooms')),
                        TextEntry::make('bathrooms')
                            ->label(__('filament.properties.fields.bathrooms')),
                        TextEntry::make('heating')
                            ->label(__('filament.properties.fields.heating'))
                            ->formatStateUsing(fn (?string $state): ?string => $state ? __("filament.properties.heating.{$state}") : null),
                        TextEntry::make('year_built')
                            ->label(__('filament.properties.fields.year_built')),
                    ])->columns(3),

                Section::make(__('filament.properties.sections.amenities'))
                    ->schema([
                        IconEntry::make('furnished')
                            ->label(__('filament.properties.fields.furnished'))
                            ->boolean(),
                        IconEntry::make('parking')
                            ->label(__('filament.properties.fields.parking'))
                            ->boolean(),
                        IconEntry::make('elevator')
                            ->label(__('filament.properties.fields.elevator'))
                            ->boolean(),
                        IconEntry::make('balcony')
                            ->label(__('filament.properties.fields.balcony'))
                            ->boolean(),
                    ])->columns(4),

                Section::make()
                    ->schema([
                        TextEntry::make('description')
                            ->label(__('filament.properties.fields.description')),
                    ])->visible(fn ($record) => filled($record->description)),
            ]);
    }
}
