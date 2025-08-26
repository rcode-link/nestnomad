<?php

namespace App\Filament\Resources\PropertyResource\Helpers;

use App\Enums\UserPropertyRelation;
use App\Models\Property;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

final class ViewInfolist
{
    public static function headerActions($infolist): array
    {
        return [Action::make('tenant')->schema([
            Select::make('tenant_id')
                ->translateLabel()
                ->searchable()
                ->getSearchResultsUsing(
                    fn(string $search, Property $property): array => User::query()
                        ->whereNotIn('id', $infolist->record->users()->pluck('users.id'))
                        ->where('name', 'like', "%{$search}%")
                        ->limit(10)
                        ->pluck('name', 'id')
                        ->toArray(),
                )
                ->getOptionLabelUsing(fn($value): ?string => User::find($value)?->name),
        ])
            ->action(function (Property $property, array $data): void {
                $property->users()->attach(
                    $data['tenant_id'],
                    [
                        'relation' => UserPropertyRelation::tenant,
                    ],
                );
                Notification::make()
                    ->title(__('New tenant is added propery'))
                    ->success()
                    ->send();
            })];
    }

    public static function tenantRow(): array
    {
        return [
            Grid::make()->schema([
                ImageEntry::make('profile_url')->label(''),
                TextEntry::make('name')
                    ->label('')->suffixAction(
                        Action::make('remove')
                            ->iconButton()
                            ->icon('heroicon-o-trash')
                            ->requiresConfirmation()
                            ->action(function (User $record, Property $property): void {
                                $property->users()->detach($record);
                                Notification::make()
                                    ->title(__('The tenant <b>:name</b> is removed from propery', ['name' => $record->name]))
                                    ->success()
                                    ->send();
                            }),
                    )
                    ->columnSpan(5),
            ])];
    }


    public static function getInfoList($schema)
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make()
                        ->schema([
                            TextEntry::make('name'),
                            TextEntry::make('address.placeName'),
                            Section::make('users')
                                ->translateLabel()
                                ->headerActions(ViewInfolist::headerActions($schema))
                                ->collapsible()
                                ->schema([
                                    RepeatableEntry::make('tenants')
                                        ->contained(false)
                                        ->label('')
                                        ->schema(ViewInfolist::tenantRow())->columns(6),
                                ]),

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
