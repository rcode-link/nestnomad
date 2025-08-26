<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;

final class MapboxSearch extends Field
{
    public $search = '';
    protected string $view = 'filament.forms.components.mapbox-search';
    private $sessionId ;


    #[Computed]
    public function searchResults($search)
    {
        if ( ! $search) {
            return [];
        }
        $token = config('app.mapbox');
        $sessionToken = Str::uuid();
        //        return "https://api.mapbox.com/search/searchbox/v1/suggest?q={$search}&access_token={$token}&session_token={$sessionToken}";
        $response = Http::get("https://api.mapbox.com/search/searchbox/v1/suggest?q={$search}&access_token={$token}&session_token={$sessionToken}");

        $data = $response->json();
        return $data['suggestions'];


    }


}
