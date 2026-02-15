<?php

namespace App\Livewire;

use App\Models\Property;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class PropertySearch extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $properties = Property::query()
            ->where('public', true)
            ->with('media')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('address->placeName', 'LIKE', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(12);

        return view('livewire.property-search', [
            'properties' => $properties,
        ]);
    }
}
