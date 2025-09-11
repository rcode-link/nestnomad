<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Filament\Infolists\Components\MaxBoxEntery;
use Filament\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
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
                            Section::make('managers')
                                ->translateLabel()
                                ->collapsible()
                                ->contained(false)
                                ->collapsed(true)
                                ->schema([
                                    RepeatableEntry::make('users')
                                        ->hiddenLabel()
                                        ->contained(false)
                                        ->schema([
                                            TextEntry::make('name'),
                                        ])->columns(3),
                                ]),
                            Section::make('users')
                                ->collapsed(true)
                                ->translateLabel()
                                ->collapsible()
                                ->contained(false)
                                ->schema([
                                    RepeatableEntry::make('tenants')
                                        ->hiddenLabel()
                                        ->contained(false)
                                        ->schema([
                                            TextEntry::make('tenant_name'),
                                            TextEntry::make('start_of_lease')
                                                ->label(''),
                                            TextEntry::make('end_of_lease')
                                                ->label(''),
                                            Action::make('contract')
                                                ->modalContent(function ($component, $state, $index) {
                $statePath = $component->getStatePath();
                $pathParts = explode('.', $statePath);
                $itemIndex = $pathParts[count($pathParts) - 1]; // Get the index
                $record = $component->getRecord();
                $item = $record->items[$itemIndex] ?? null;

                                                    dd($statePath, $pathParts, $itemIndex, $record, $item, $state, $index);
            })
                                        ])->columns(4),
                                ]),

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
