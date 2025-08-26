<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
     x-data="{ state: $wire.$entangle('{{ $getStatePath() }}'), show:false }"

            x-on:blur="show=false"
    >
    <x-filament::input.wrapper
    >
        <x-filament::input wire:model.live="data.search"
            class="bg-gray-900"
            x-on:focus="show=true"
       />

            </x-filament::input.wrapper>
<div x-show="show" class="absolute bg-gray-900">
                @foreach($searchResults($get('search')) as $arr)
                    <div class="dropdown-item cursor-pointer" >
                        <p>{{$arr['name']}}</p>
                        <small>{{$arr['place_formatted']}}</small>
                    </div>
                @endforeach
        </div>

    </div>
</x-dynamic-component>
