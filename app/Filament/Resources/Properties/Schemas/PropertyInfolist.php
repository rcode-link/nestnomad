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

                            TextEntry::make('floor')
                                ->label(__('filament.properties.fields.floor'))
                                ->inlineLabel()
                                ->hidden(fn($record) => blank($record->floor)),
                            TextEntry::make('size')
                                ->label(__('filament.properties.fields.size'))
                                ->suffix(' m²')
                                ->inlineLabel()
                                ->hidden(fn($record) => blank($record->size)),
                            TextEntry::make('rooms')
                                ->label(__('filament.properties.fields.rooms'))
                                ->inlineLabel()
                                ->hidden(fn($record) => blank($record->rooms)),
                            TextEntry::make('bathrooms')
                                ->label(__('filament.properties.fields.bathrooms'))
                                ->inlineLabel()
                                ->hidden(fn($record) => blank($record->bathrooms)),
                            TextEntry::make('heating')
                                ->label(__('filament.properties.fields.heating'))
                                ->formatStateUsing(fn(?string $state): ?string => $state ? __("filament.properties.heating.{$state}") : null)
                                ->inlineLabel()
                                ->hidden(fn($record) => blank($record->heating)),
                            TextEntry::make('year_built')
                                ->label(__('filament.properties.fields.year_built'))
                                ->inlineLabel()
                                ->hidden(fn($record) => blank($record->year_built)),

                            IconEntry::make('furnished')
                                ->label(__('filament.properties.fields.furnished'))
                                ->boolean()
                                ->inlineLabel()
                                ->visible(fn($record) => (bool) $record->furnished),
                            IconEntry::make('parking')
                                ->label(__('filament.properties.fields.parking'))
                                ->boolean()
                                ->inlineLabel()
                                ->visible(fn($record) => (bool) $record->parking),
                            IconEntry::make('elevator')
                                ->label(__('filament.properties.fields.elevator'))
                                ->boolean()
                                ->inlineLabel()
                                ->visible(fn($record) => (bool) $record->elevator),
                            IconEntry::make('balcony')
                                ->label(__('filament.properties.fields.balcony'))
                                ->boolean()
                                ->inlineLabel()
                                ->visible(fn($record) => (bool) $record->balcony),
                        ]),
                ])->from('md'),
                Flex::make([
                    Section::make()
                        ->schema([
                            MaxBoxEntery::make('address'),
                        ]),
                ])->from('md')->verticallyAlignCenter(),

                Section::make()
                    ->schema([
                        TextEntry::make('description')
                            ->label(__('filament.properties.fields.description')),
                    ])->visible(fn($record) => filled($record->description)),
            ]);
    }
}
