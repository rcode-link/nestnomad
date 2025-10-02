<style>
    .mapbox-search {
        z-index: 10;
        width: 100%;
        margin-top: calc(var(--spacing) * 2);
        border-radius: var(--radius-lg);
        background-color: var(--color-white);
        --tw-shadow:
            0 10px 15px -3px var(--tw-shadow-color, #0000001a),
            0 4px 6px -4px var(--tw-shadow-color, #0000001a);
        box-shadow:
            var(--tw-inset-shadow), var(--tw-inset-ring-shadow),
            var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
            var(--tw-shadow);
        --tw-ring-shadow: var(--tw-ring-inset,) 0 0 0
            calc(1px + var(--tw-ring-offset-width))
            var(--tw-ring-color, currentcolor);
        box-shadow:
            var(--tw-inset-shadow), var(--tw-inset-ring-shadow),
            var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
            var(--tw-shadow);
        --tw-ring-color: var(--gray-950);
        position: absolute;
        overflow: auto;
    }
    .mapbox-container {
        position: relative;
    }
    .mapbox-item {
        border-radius: var(--radius-lg);

        padding: calc(var(--spacing) * 2);
    }
    .mapbox-item:hover {
        cursor: pointer;
        background-color: var(--gray-200);
    }
</style>

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @livewire(
        MapboxSearch::class,
        [
            $applyStateBindingModifiers("wire:model.live") => $getStatePath(),
        ]
    )
</x-dynamic-component>
