<div>
    <div class="mx-auto mb-12 max-w-[600px]">
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="@lang('public.properties.search_placeholder')"
            class="w-full rounded-md border border-stroke dark:border-dark-3 bg-transparent px-5 py-3 text-base text-body-color dark:text-dark-6 outline-none transition focus:border-primary dark:focus:border-primary"
        />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
        @forelse ($properties as $property)
            <a href="{{ route('properties.show', $property) }}" class="block">
                <div
                    class="wow fadeInUp overflow-hidden rounded-lg bg-white dark:bg-dark-2 shadow-md hover:shadow-lg transition duration-300"
                    data-wow-delay=".1s"
                >
                    <div class="h-36 overflow-hidden bg-gray-200 dark:bg-dark-3">
                        @if ($property->getFirstMediaUrl('gallery'))
                            <img
                                src="{{ $property->getFirstMediaUrl('gallery') }}"
                                alt="{{ $property->name }}"
                                class="h-full w-full object-cover"
                                loading="lazy"
                            />
                        @elseif (!empty($property->address['coords']))
                            <img
                                src="https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/pin-s+3b82f6({{ $property->address['coords'][0] }},{{ $property->address['coords'][1] }})/{{ $property->address['coords'][0] }},{{ $property->address['coords'][1] }},14,0/400x144@2x?access_token={{ config('app.mapbox') }}"
                                alt="{{ $property->name }}"
                                class="h-full w-full object-cover"
                                loading="lazy"
                            />
                        @else
                            <img
                                src="https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/0,20,1,0/400x144@2x?access_token={{ config('app.mapbox') }}"
                                alt="{{ $property->name }}"
                                class="h-full w-full object-cover"
                                loading="lazy"
                            />
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-lg font-bold text-dark dark:text-white truncate" title="{{ $property->name }}">
                            {{ $property->name }}
                        </h3>
                        @if ($property->address['placeName'] ?? null)
                            <p class="text-sm text-body-color dark:text-dark-6 flex items-center gap-1">
                                <x-filament::icon
                                    icon="heroicon-o-map-pin"
                                    class="w-4 shrink-0"
                                />
                                <span class="truncate">{{ $property->address['placeName'] }}</span>
                            </p>
                        @endif
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full">
                <div class="mx-auto max-w-[485px] text-center py-12">
                    <x-filament::icon
                        icon="heroicon-o-magnifying-glass"
                        class="w-16 mx-auto mb-4 text-gray-400 dark:text-dark-6"
                    />
                    <p class="text-base text-body-color dark:text-dark-6">
                        @lang('public.properties.no_results')
                    </p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $properties->links() }}
    </div>
</div>
