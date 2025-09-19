<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;

final class MapboxSearch extends Component
{
    /**
     * @var string | array<string> | null
     */
    #[Modelable]
    public string | array | null $state = null;

    public $search = '';

    public bool $show = false;

    private string $sessionToken = '';

    public function mount(): void
    {
        $this->search = $this->state['placeName'] ?? '';
    }

    public function render()
    {
        $this->sessionToken = Str::uuid();
        return view('livewire.mapbox-search');
    }

    #[Computed]
    public function results()
    {
        if ( ! $this->search || ! $this->show) {
            return [];
        }
        $token = config('app.mapbox');
        $search = $this->search;
        $sessionToken = $this->sessionToken;
        $response = Http::get("https://api.mapbox.com/search/searchbox/v1/suggest?q={$search}&access_token={$token}&session_token={$sessionToken}");
        $data = $response->json();
        return $data['suggestions'];

    }


    public function handleClick($id): void
    {
        $token = config('app.mapbox');
        $sessionToken = $this->sessionToken;
        $response = Http::get("https://api.mapbox.com/search/searchbox/v1/retrieve/${id}?access_token=${token}&session_token={$sessionToken}");
        $responseData = $response->json();
        $properties = $responseData['features'][0]['properties'];
        $coords = $responseData['features'][0]['geometry']['coordinates'];

        $data = [
            "address" => $properties['address'] ?? '',
            "street" => $properties['context']['street']['name'] ?? '',
            "postcode" => $properties['context']['postcode']['name'],
            "place" => $properties['context']['place']['name'] ?? '',
            "region" => $properties['context']['region']['name'] ?? '',
            "country" => $properties['context']['country']['name'] ?? '',
            "placeName" => $properties['full_address'] ?? $properties['name'] . '' . $properties['place_formatted'],
            "coords" => $coords,
        ];
        $this->search = $data['placeName'];
        $this->state = $data;
    }


}
