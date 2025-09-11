<?php

namespace App\Filament\Resources\PropertyResource\Helpers;

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
                        ]),
                ])->from('md'),
                Flex::make([
                    Section::make()->schema([
                        ImageEntry::make('map')
                            ->label('')
                            ->defaultImageUrl('https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/geojson(%7B%22type%22%3A%22Point%22%2C%22coordinates%22%3A[17.223641%2C44.770596]%7D)/17.223641,44.770596,16/500x300?access_token=pk.eyJ1IjoicmFkYW5zdHVwYXIiLCJhIjoiY21kaGFxdGRjMDFoYjJpc2duNzdlczFkZiJ9._iKOIqh7fXaQfIF-_TAXGg')
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
