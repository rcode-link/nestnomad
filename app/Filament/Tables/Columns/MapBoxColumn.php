<?php

namespace App\Filament\Tables\Columns;

use Filament\Support\Components\Contracts\HasEmbeddedView;
use Filament\Tables\Columns\Column;

final class MapBoxColumn extends Column implements HasEmbeddedView
{
    public function toEmbeddedHtml(): string
    {
        $coords = join(', ', array_values($this->getState()['coords']));
        $link = "https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/geojson(%7B%22type%22%3A%22Point%22%2C%22coordinates%22%3A[{$coords}]%7D)/{$coords},16/500x300?access_token=pk.eyJ1IjoicmFkYW5zdHVwYXIiLCJhIjoiY21kaGFxdGRjMDFoYjJpc2duNzdlczFkZiJ9._iKOIqh7fXaQfIF-_TAXGg";

        ob_start(); ?>

        <div>
        <img
        style="width: 100%"
        class="w-full h-auto block"
        src="<?= $link ?>" />
        </div>

        <?php return ob_get_clean();
    }
}
