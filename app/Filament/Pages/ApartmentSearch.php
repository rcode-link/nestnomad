<?php

namespace App\Filament\Pages;

use App\Models\Property;
use Filament\Actions\Action;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Pages\Page;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class ApartmentSearch extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedMagnifyingGlass;

    protected string $view = 'filament.pages.apartment-search';

    public static function getNavigationLabel(): string
    {
        return __('filament.apartment_search.title');
    }

    public function getTitle(): string
    {
        return __('filament.apartment_search.title');
    }

    private static function getPropertyImageUrl(Property $record): ?string
    {
        $galleryUrl = $record->getFirstMediaUrl('gallery');
        if ($galleryUrl) {
            return $galleryUrl;
        }

        $coords = $record->address['coords'] ?? null;
        if ($coords) {
            return "https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/pin-s+3b82f6({$coords[0]},{$coords[1]})/{$coords[0]},{$coords[1]},14,0/400x200@2x?access_token=" . config('app.mapbox');
        }

        return null;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => Property::query()
                    ->where('public', true)
                    ->withCount('reviews')
                    ->withAvg('reviews', 'rating')
                    ->with('lease', 'media', 'reviews.user'),
            )
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                Stack::make([
                    ImageColumn::make('image')
                        ->state(fn (Property $record): ?string => self::getPropertyImageUrl($record))
                        ->height(180)
                        ->width('100%')
                        ->extraImgAttributes(['class' => 'rounded-lg object-cover w-full']),

                    TextColumn::make('name')
                        ->weight('bold')
                        ->size('lg')
                        ->description(fn (Property $record): ?string => $record->address['placeName'] ?? null),

                    Split::make([
                        TextColumn::make('rooms')
                            ->icon(Heroicon::OutlinedSquares2x2)
                            ->formatStateUsing(fn ($state) => $state . ' ' . __('filament.properties.fields.rooms'))
                            ->grow(false)
                            ->color('gray')
                            ->visible(fn (?Property $record): bool => filled($record?->rooms)),
                        TextColumn::make('size')
                            ->icon(Heroicon::OutlinedArrowsPointingOut)
                            ->suffix(' m²')
                            ->grow(false)
                            ->color('gray')
                            ->visible(fn (?Property $record): bool => filled($record?->size)),
                        TextColumn::make('floor')
                            ->icon(Heroicon::OutlinedBuildingOffice)
                            ->formatStateUsing(fn ($state) => __('filament.properties.fields.floor') . ' ' . $state)
                            ->grow(false)
                            ->color('gray')
                            ->visible(fn (?Property $record): bool => filled($record?->floor)),
                    ]),

                    Split::make([
                        IconColumn::make('furnished')
                            ->boolean()
                            ->trueIcon(Heroicon::OutlinedHome)
                            ->falseIcon(Heroicon::OutlinedHome)
                            ->trueColor('success')
                            ->falseColor('gray')
                            ->grow(false)
                            ->tooltip(__('filament.properties.fields.furnished')),
                        IconColumn::make('parking')
                            ->boolean()
                            ->trueIcon(Heroicon::OutlinedTruck)
                            ->falseIcon(Heroicon::OutlinedTruck)
                            ->trueColor('success')
                            ->falseColor('gray')
                            ->grow(false)
                            ->tooltip(__('filament.properties.fields.parking')),
                        IconColumn::make('elevator')
                            ->boolean()
                            ->trueIcon(Heroicon::OutlinedArrowsUpDown)
                            ->falseIcon(Heroicon::OutlinedArrowsUpDown)
                            ->trueColor('success')
                            ->falseColor('gray')
                            ->grow(false)
                            ->tooltip(__('filament.properties.fields.elevator')),
                        IconColumn::make('balcony')
                            ->boolean()
                            ->trueIcon(Heroicon::OutlinedSun)
                            ->falseIcon(Heroicon::OutlinedSun)
                            ->trueColor('success')
                            ->falseColor('gray')
                            ->grow(false)
                            ->tooltip(__('filament.properties.fields.balcony')),
                        TextColumn::make('reviews_avg_rating')
                            ->icon(Heroicon::Star)
                            ->color('warning')
                            ->numeric(1)
                            ->grow(false)
                            ->placeholder(''),
                        TextColumn::make('reviews_count')
                            ->badge()
                            ->color('gray')
                            ->formatStateUsing(fn ($state) => $state . ' ' . __('filament.reviews.title'))
                            ->grow(false)
                            ->visible(fn (?Property $record): bool => ($record?->reviews_count ?? 0) > 0),
                    ]),

                    TextColumn::make('availability')
                        ->state(function (Property $record): string {
                            $hasActiveLease = $record->lease
                                ->filter(fn ($lease) => $lease->end_of_lease === null || $lease->end_of_lease > now())
                                ->isNotEmpty();

                            return $hasActiveLease
                                ? __('filament.apartment_search.occupied')
                                : __('filament.apartment_search.available');
                        })
                        ->badge()
                        ->color(fn (string $state): string => $state === __('filament.apartment_search.available') ? 'success' : 'danger'),
                ]),
            ])
            ->recordAction('view')
            ->recordActions([
                Action::make('view')
                    ->slideOver()
                    ->modalHeading(fn (Property $record) => $record->name)
                    ->infolist(function (Property $record): array {
                        return [
                            ImageEntry::make('cover_image')
                                ->label('')
                                ->state(fn () => self::getPropertyImageUrl($record))
                                ->height(250)
                                ->extraImgAttributes(['class' => 'rounded-lg object-cover w-full']),

                            Section::make(__('filament.properties.sections.gallery'))
                                ->schema([
                                    SpatieMediaLibraryImageEntry::make('gallery')
                                        ->collection('gallery')
                                        ->label(''),
                                ])
                                ->collapsible()
                                ->visible(fn () => $record->getMedia('gallery')->count() > 1),

                            TextEntry::make('address.placeName')
                                ->label(__('filament.properties.fields.address'))
                                ->icon(Heroicon::OutlinedMapPin),

                            Flex::make([
                                TextEntry::make('rooms')
                                    ->label(__('filament.properties.fields.rooms'))
                                    ->icon(Heroicon::OutlinedSquares2x2)
                                    ->visible(fn () => filled($record->rooms)),
                                TextEntry::make('size')
                                    ->label(__('filament.properties.fields.size'))
                                    ->suffix(' m²')
                                    ->icon(Heroicon::OutlinedArrowsPointingOut)
                                    ->visible(fn () => filled($record->size)),
                                TextEntry::make('floor')
                                    ->label(__('filament.properties.fields.floor'))
                                    ->icon(Heroicon::OutlinedBuildingOffice)
                                    ->visible(fn () => filled($record->floor)),
                                TextEntry::make('bathrooms')
                                    ->label(__('filament.properties.fields.bathrooms'))
                                    ->visible(fn () => filled($record->bathrooms)),
                                TextEntry::make('year_built')
                                    ->label(__('filament.properties.fields.year_built'))
                                    ->visible(fn () => filled($record->year_built)),
                            ])->from('md'),

                            TextEntry::make('heating')
                                ->label(__('filament.properties.fields.heating'))
                                ->formatStateUsing(fn (?string $state): ?string => $state ? __("filament.properties.heating.{$state}") : null)
                                ->visible(fn () => filled($record->heating)),

                            Flex::make([
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
                            ])->from('md'),

                            Section::make(__('filament.properties.fields.description'))
                                ->schema([
                                    TextEntry::make('description')
                                        ->label('')
                                        ->markdown(),
                                ])
                                ->visible(fn () => filled($record->description)),

                            Section::make(__('filament.reviews.title'))
                                ->schema([
                                    RepeatableEntry::make('reviews')
                                        ->label('')
                                        ->schema([
                                            Flex::make([
                                                TextEntry::make('user.name')
                                                    ->label(__('filament.reviews.fields.reviewer'))
                                                    ->icon(Heroicon::OutlinedUser),
                                                TextEntry::make('rating')
                                                    ->label(__('filament.reviews.fields.rating'))
                                                    ->icon(Heroicon::Star)
                                                    ->color('warning')
                                                    ->formatStateUsing(fn (int $state): string => str_repeat('★', $state) . str_repeat('☆', 5 - $state)),
                                                TextEntry::make('created_at')
                                                    ->label(__('filament.reviews.fields.date'))
                                                    ->date(),
                                            ])->from('md'),
                                            TextEntry::make('comment')
                                                ->label('')
                                                ->visible(fn ($record) => filled($record->comment)),
                                        ]),
                                ])
                                ->visible(fn () => $record->reviews->isNotEmpty()),
                        ];
                    }),
            ])
            ->filters([
                Filter::make('search')
                    ->form([
                        TextInput::make('search')
                            ->label(__('filament.common.actions.search'))
                            ->placeholder(__('filament.common.actions.search') . '...')
                            ->prefixIcon(Heroicon::OutlinedMagnifyingGlass),
                    ])
                    ->query(fn (Builder $query, array $data) => $query
                        ->when($data['search'] ?? null, fn (Builder $q, string $search) => $q
                            ->where(fn (Builder $q2) => $q2
                                ->where('name', 'like', "%{$search}%")
                                ->orWhereRaw("JSON_EXTRACT(address, '$.placeName') LIKE ?", ["%{$search}%"])
                            )
                        )
                    )
                    ->columnSpanFull(),
                TernaryFilter::make('available_only')
                    ->label(__('filament.apartment_search.available'))
                    ->queries(
                        true: fn (Builder $query) => $query->whereDoesntHave('lease', fn (Builder $q) => $q
                            ->where(fn (Builder $q2) => $q2->where('end_of_lease', '>', now())->orWhereNull('end_of_lease'))),
                        false: fn (Builder $query) => $query,
                    ),
                TernaryFilter::make('furnished')
                    ->label(__('filament.properties.fields.furnished')),
                TernaryFilter::make('parking')
                    ->label(__('filament.properties.fields.parking')),
                TernaryFilter::make('elevator')
                    ->label(__('filament.properties.fields.elevator')),
            ])
            ->filtersLayout(\Filament\Tables\Enums\FiltersLayout::AboveContent)
            ->filtersFormColumns(4)
            ->emptyStateHeading(__('filament.apartment_search.no_results'))
            ->emptyStateIcon(Heroicon::OutlinedMagnifyingGlass);
    }
}
