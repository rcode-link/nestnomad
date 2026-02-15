<x-app>
    @include("components.menu")
    <div
        id="home"
        class="relative overflow-hidden bg-primary -mt-[75px] pt-[120px] pb-[60px] md:pt-[130px] lg:pt-[160px]"
    >
        <div class="container px-4 mx-auto">
            <div class="flex flex-wrap items-center -mx-4">
                <div class="w-full px-4">
                    <div class="hero-content wow fadeInUp mx-auto max-w-[780px] text-center">
                        <h1 class="mb-4 text-3xl font-bold leading-snug text-white sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-[1.2]">
                            {{ $property->name }}
                        </h1>
                        @if ($property->address['placeName'] ?? null)
                            <p class="mx-auto max-w-[600px] text-base font-medium text-white/80 sm:text-lg flex items-center justify-center gap-2">
                                <x-filament::icon icon="heroicon-o-map-pin" class="w-5 shrink-0" />
                                {{ $property->address['placeName'] }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pb-8 pt-20 dark:bg-dark lg:pb-[70px] lg:pt-[120px]">
        <div class="container px-4 mx-auto">
            <div class="mb-8">
                <a href="{{ route('properties') }}" class="inline-flex items-center gap-2 text-primary hover:opacity-70 transition">
                    <x-filament::icon icon="heroicon-o-arrow-left" class="w-5" />
                    @lang('public.properties.back')
                </a>
            </div>

            <div class="flex flex-wrap -mx-4">
                {{-- Main content --}}
                <div class="w-full px-4 lg:w-2/3">
                    {{-- Gallery --}}
                    @php
                        $galleryImages = $property->getMedia('gallery');
                    @endphp
                    @if ($galleryImages->count())
                        <div class="mb-8">
                            <h2 class="mb-4 text-xl font-bold text-dark dark:text-white">
                                @lang('public.properties.gallery')
                            </h2>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                @foreach ($galleryImages as $image)
                                    <div class="overflow-hidden rounded-lg">
                                        <img
                                            src="{{ $image->getUrl() }}"
                                            alt="{{ $property->name }}"
                                            class="h-48 w-full object-cover hover:scale-105 transition duration-300"
                                            loading="lazy"
                                        />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Description --}}
                    @if ($property->description)
                        <div class="mb-8">
                            <h2 class="mb-4 text-xl font-bold text-dark dark:text-white">
                                @lang('filament.properties.fields.description')
                            </h2>
                            <p class="text-body-color dark:text-dark-6 leading-relaxed">
                                {{ $property->description }}
                            </p>
                        </div>
                    @endif

                    {{-- Map --}}
                    @if (!empty($property->address['coords']))
                        <div class="mb-8">
                            <img
                                src="https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/pin-l+3b82f6({{ $property->address['coords'][0] }},{{ $property->address['coords'][1] }})/{{ $property->address['coords'][0] }},{{ $property->address['coords'][1] }},14,0/800x400@2x?access_token={{ config('app.mapbox') }}"
                                alt="Map"
                                class="w-full rounded-lg"
                                loading="lazy"
                            />
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="w-full px-4 lg:w-1/3">
                    {{-- Details --}}
                    <div class="mb-8 rounded-lg bg-white dark:bg-dark-2 p-6 shadow-md">
                        <h2 class="mb-6 text-xl font-bold text-dark dark:text-white">
                            @lang('public.properties.details')
                        </h2>
                        <div class="space-y-4">
                            @if ($property->floor !== null)
                                <div class="flex justify-between border-b border-stroke dark:border-dark-3 pb-3">
                                    <span class="text-body-color dark:text-dark-6">@lang('public.properties.floor')</span>
                                    <span class="font-medium text-dark dark:text-white">{{ $property->floor }}</span>
                                </div>
                            @endif
                            @if ($property->size)
                                <div class="flex justify-between border-b border-stroke dark:border-dark-3 pb-3">
                                    <span class="text-body-color dark:text-dark-6">@lang('public.properties.size')</span>
                                    <span class="font-medium text-dark dark:text-white">{{ $property->size }} m²</span>
                                </div>
                            @endif
                            @if ($property->rooms)
                                <div class="flex justify-between border-b border-stroke dark:border-dark-3 pb-3">
                                    <span class="text-body-color dark:text-dark-6">@lang('public.properties.rooms')</span>
                                    <span class="font-medium text-dark dark:text-white">{{ $property->rooms }}</span>
                                </div>
                            @endif
                            @if ($property->bathrooms)
                                <div class="flex justify-between border-b border-stroke dark:border-dark-3 pb-3">
                                    <span class="text-body-color dark:text-dark-6">@lang('public.properties.bathrooms')</span>
                                    <span class="font-medium text-dark dark:text-white">{{ $property->bathrooms }}</span>
                                </div>
                            @endif
                            @if ($property->heating)
                                <div class="flex justify-between border-b border-stroke dark:border-dark-3 pb-3">
                                    <span class="text-body-color dark:text-dark-6">@lang('public.properties.heating')</span>
                                    <span class="font-medium text-dark dark:text-white">@lang("public.properties.heating_types.{$property->heating}")</span>
                                </div>
                            @endif
                            @if ($property->year_built)
                                <div class="flex justify-between pb-3">
                                    <span class="text-body-color dark:text-dark-6">@lang('public.properties.year_built')</span>
                                    <span class="font-medium text-dark dark:text-white">{{ $property->year_built }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Amenities --}}
                    @if ($property->furnished || $property->parking || $property->elevator || $property->balcony)
                        <div class="mb-8 rounded-lg bg-white dark:bg-dark-2 p-6 shadow-md">
                            <h2 class="mb-6 text-xl font-bold text-dark dark:text-white">
                                @lang('public.properties.amenities')
                            </h2>
                            <div class="grid grid-cols-2 gap-4">
                                @if ($property->furnished)
                                    <div class="flex items-center gap-2">
                                        <x-filament::icon icon="heroicon-o-check-circle" class="w-5 text-green-500" />
                                        <span class="text-body-color dark:text-dark-6">@lang('public.properties.furnished')</span>
                                    </div>
                                @endif
                                @if ($property->parking)
                                    <div class="flex items-center gap-2">
                                        <x-filament::icon icon="heroicon-o-check-circle" class="w-5 text-green-500" />
                                        <span class="text-body-color dark:text-dark-6">@lang('public.properties.parking')</span>
                                    </div>
                                @endif
                                @if ($property->elevator)
                                    <div class="flex items-center gap-2">
                                        <x-filament::icon icon="heroicon-o-check-circle" class="w-5 text-green-500" />
                                        <span class="text-body-color dark:text-dark-6">@lang('public.properties.elevator')</span>
                                    </div>
                                @endif
                                @if ($property->balcony)
                                    <div class="flex items-center gap-2">
                                        <x-filament::icon icon="heroicon-o-check-circle" class="w-5 text-green-500" />
                                        <span class="text-body-color dark:text-dark-6">@lang('public.properties.balcony')</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-app>
