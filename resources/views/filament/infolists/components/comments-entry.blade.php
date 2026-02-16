<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div {{ $getExtraAttributeBag() }}>
        <livewire:issue-comments :issue="$getRecord()" />
    </div>
</x-dynamic-component>
