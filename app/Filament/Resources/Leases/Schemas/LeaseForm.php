<?php

namespace App\Filament\Resources\Leases\Schemas;

use App\Models\Property;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
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

        if ('create' !== $schema->getOperation()) {
            $schema->model->load('user');
        }

        return $schema
            ->components([
                Tabs::make('create_lease')
                    ->translateLabel()
                    ->tabs([
                        Tab::make('base_information')

                            ->label(__('filament.leases.tabs.base_information'))
                            ->schema([
                                Select::make('property_id')
                                    ->label(__('filament.leases.fields.property'))
                                    ->required()
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
                                            ->label(__('filament.leases.fields.start_date'))
                                            ->required(),
                                        DatePicker::make('end_of_lease')
                                            ->label(__('filament.leases.fields.end_date')),
                                    ]),
                                Repeater::make('user')
                                    ->label(__('filament.leases.fields.tenant'))
                                    ->relationship()
                                    ->schema([Flex::make([
                                        Select::make('user_id')
                                            ->label(__('filament.leases.fields.tenant_email'))
                                            ->grow(true)
                                            ->searchable()
                                            ->getSearchResultsUsing(fn(string $search): array => User::query()
                                                ->where('email', $search)
                                                ->limit(50)
                                                ->pluck('email', 'id')
                                                ->all())
                                            ->live()
                                            ->afterStateUpdated(fn($get, $set) => $set('tenant_name', User::find($get('user_id'))?->name))
                                            ->getOptionLabelUsing(fn($value): ?string => User::find($value)?->email),
                                        //TextEntry::make('or')->hiddenLabel()->state('or')->grow(false),
                                        TextInput::make('tenant_name')
                                            ->label(__('filament.leases.fields.tenant_name'))
                                            ->live()
                                            ->required()
                                            ->readOnly(fn($get) => $get('user_id')),
                                    ])->verticallyAlignCenter()]),
                            ]),
                        Tab::make('contract')
                            ->label(__('filament.leases.tabs.contract'))
                            ->schema([
                                RichEditor::make('contract')
                                    ->json()
                                    ->floatingToolbars([
                                        'paragraph' => [
                                            'bold', 'italic', 'underline', 'strike', 'subscript', 'superscript',
                                        ],
                                        'heading' => [
                                            'h1', 'h2', 'h3',
                                        ],
                                        'table' => [
                                            'tableAddColumnBefore', 'tableAddColumnAfter', 'tableDeleteColumn',
                                            'tableAddRowBefore', 'tableAddRowAfter', 'tableDeleteRow',
                                            'tableMergeCells', 'tableSplitCell',
                                            'tableToggleHeaderRow',
                                            'tableDelete',
                                        ],
                                    ])
                                    ->default(null)
                                    ->columnSpanFull(),

                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
