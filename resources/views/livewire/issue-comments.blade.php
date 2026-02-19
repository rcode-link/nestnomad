<div class="space-y-6" wire:poll.15s>
    <h3 class="text-lg font-semibold text-gray-950 dark:text-white">
        {{ __('filament.comments.title') }}
    </h3>

        {{ $this->form }}
    {{ $this->commentsInfolist }}

    <x-filament-actions::modals />
</div>
