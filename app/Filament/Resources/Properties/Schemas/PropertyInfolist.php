<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Filament\Infolists\Components\MaxBoxEntery;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
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

                Tabs::make('property')
                    ->tabs([
                        Tab::make('gallery')
                            ->icon('heroicon-o-photo')
                            ->translateLabel()
                            ->schema([
                            ]),
                    ])->columnSpanFull()
                    ->contained(false),

            ]);
    }
}
