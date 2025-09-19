@commenterStyles
@commenterScripts

<x-dynamic-component
    :component="$getEntryWrapperView()"
    :entry="$entry"
>
    <div {{ $getExtraAttributeBag() }}>
       <x-commenter::index :model="$getRecord()" />
    </div>
</x-dynamic-component>
