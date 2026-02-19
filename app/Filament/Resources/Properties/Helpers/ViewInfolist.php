<?php

namespace App\Filament\Resources\PropertyResource\Helpers;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

final class ViewInfolist
{
    public static function getInfoList($schema)
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
                                ->hidden(fn ($record) => blank($record->floor)),
                            TextEntry::make('size')
                                ->label(__('filament.properties.fields.size'))
                                ->suffix(' m²')
                                ->inlineLabel()
                                ->hidden(fn ($record) => blank($record->size)),
                            TextEntry::make('rooms')
                                ->label(__('filament.properties.fields.rooms'))
                                ->inlineLabel()
                                ->hidden(fn ($record) => blank($record->rooms)),
                            TextEntry::make('bathrooms')
                                ->label(__('filament.properties.fields.bathrooms'))
                                ->inlineLabel()
                                ->hidden(fn ($record) => blank($record->bathrooms)),
                            TextEntry::make('heating')
                                ->label(__('filament.properties.fields.heating'))
                                ->formatStateUsing(fn (?string $state): ?string => $state ? __("filament.properties.heating.{$state}") : null)
                                ->inlineLabel()
                                ->hidden(fn ($record) => blank($record->heating)),
                            TextEntry::make('year_built')
                                ->label(__('filament.properties.fields.year_built'))
                                ->inlineLabel()
                                ->hidden(fn ($record) => blank($record->year_built)),

                            IconEntry::make('furnished')
                                ->label(__('filament.properties.fields.furnished'))
                                ->boolean()
                                ->inlineLabel()
                                ->visible(fn ($record) => (bool) $record->furnished),
                            IconEntry::make('parking')
                                ->label(__('filament.properties.fields.parking'))
                                ->boolean()
                                ->inlineLabel()
                                ->visible(fn ($record) => (bool) $record->parking),
                            IconEntry::make('elevator')
                                ->label(__('filament.properties.fields.elevator'))
                                ->boolean()
                                ->inlineLabel()
                                ->visible(fn ($record) => (bool) $record->elevator),
                            IconEntry::make('balcony')
                                ->label(__('filament.properties.fields.balcony'))
                                ->boolean()
                                ->inlineLabel()
                                ->visible(fn ($record) => (bool) $record->balcony),
                        ]),
                ])->from('md'),
                Flex::make([
                    Section::make()->schema([
                        ImageEntry::make('map')
                            ->label('')
                            ->defaultImageUrl('https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/geojson(%7B%22type%22%3A%22Point%22%2C%22coordinates%22%3A[17.223641%2C44.770596]%7D)/17.223641,44.770596,16/500x300?access_token=' . config('mapbox.access_token'))
                            ->width('100%')
                            ->height('auto')
                            ->alignCenter(),
                    ]),
                ])->from('md')->verticallyAlignCenter(),

                Tabs::make('property')
                    ->tabs([
                        Tab::make('gallery')
                            ->icon('heroicon-o-photo')
                            ->translateLabel()
                            ->schema([
                                SpatieMediaLibraryImageEntry::make('images')
                                    ->visibility('private')
                                    ->label('')
                                    ->allCollections(),
                            ]),
                    ])->columnSpanFull()
                    ->contained(false),

            ]);
    }
}
