<?php

namespace App\Filament\Resources\Leases\Schemas;

use App\Models\Property;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

final class LeaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('create_lease')
                    ->translateLabel()
                    ->tabs([
                    Tab::make('base_infrmation')
                        ->translateLabel()
                        ->schema([
                            Select::make('property_id')
                                ->searchable()
                                ->getSearchResultsUsing(fn(string $search): array => Property::query()
                                    ->where('name', 'like', "%{$search}%")
                                    ->limit(50)
                                    ->pluck('name', 'id')
                                    ->all())
                                ->getOptionLabelUsing(fn($value): ?string => Property::find($value)?->name),
                            Grid::make()
                                ->columns([
                                    'sm' => 1,
                                    'md' => 2,
                                ])->schema([
                                    DatePicker::make('start_of_lease')
                                        ->required(),
                                    DatePicker::make('end_of_lease'),
                                ]),
                            Flex::make([
                                Select::make('user_id')
                                    ->grow(true)
                                    ->searchable()
                                    ->getSearchResultsUsing(fn(string $search): array => User::query()
                                        ->where('name', 'like', "%{$search}%")
                                        ->limit(50)
                                        ->pluck('name', 'id')
                                        ->all())
                                    ->live()
                                    ->afterStateUpdated(fn($get, $set) => $set('tenant_name', User::find($get('user_id'))?->name))
                                    ->getOptionLabelUsing(fn($value): ?string => User::find($value)?->name),
                                TextEntry::make('or')->hiddenLabel()->state('or')->grow(false),
                                TextInput::make('tenant_name')->live()->readOnly(fn($get) => $get('user_id')),
                            ])->verticallyAlignCenter(),
                        ]),
                    Tab::make('contract')
                        ->translateLabel()
                        ->schema([
                            RichEditor::make('contract')
                                ->json()
                                ->default(null)
                                ->columnSpanFull(),

                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
