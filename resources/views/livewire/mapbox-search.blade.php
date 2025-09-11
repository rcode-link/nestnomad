<div class="mapbox-container"  >

    <x-filament::input.wrapper
    >
        <x-filament::input
        x-on:focus="$wire.show = true"
        x-on:blur="$wire.show = false"
        wire:model.live.debounce="search"
        class="bg-gray-900"
       />

            </x-filament::input.wrapper>
            <div wire:show="show"  x-transition.duration.500ms class="mapbox-search">
                @foreach($this->results as $arr)
                    <div class="mapbox-item" x-transition.duration.100ms wire:click="handleClick('{{$arr['mapbox_id']}}')">
                        <p>{{$arr['name']}}</p>
                        <small>{{$arr['place_formatted']}}</small>
                    </div>
                @endforeach
            </div>


</div>
