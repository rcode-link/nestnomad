<x-dynamic-component
    :component="$getEntryWrapperView()"
    :entry="$entry"
>
    <div {{ $getExtraAttributeBag() }}>
        <img
        class="w-full h-auto block"
        src="https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/geojson(%7B%22type%22%3A%22Point%22%2C%22coordinates%22%3A[{{join(', ',$getState()['coords'])}}]%7D)/{{join(', ',$getState()['coords'])}},16/500x300?access_token=pk.eyJ1IjoicmFkYW5zdHVwYXIiLCJhIjoiY21kaGFxdGRjMDFoYjJpc2duNzdlczFkZiJ9._iKOIqh7fXaQfIF-_TAXGg"
    </div>
</x-dynamic-component>
