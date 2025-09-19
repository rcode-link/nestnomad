<?php

namespace App\Filament\Resources\Properties\Widgets;

use App\Helpers\ColorGenerator;
use App\Models\{Expanse, Property};
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\{Trend, TrendValue};

final class PaymentsChart extends ChartWidget
{
    protected ?string $heading = "Expanses";

    protected function random_color_part()
    {
        return mb_str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }


    protected function getData(): array
    {
        $expenses = Property::query()->iCanAccess()->with('lease')->get()->map(function ($obj) {
            $trend = Trend::query(Expanse::query()->whereIn('lease_id', $obj->lease->pluck('id')))
                ->dateColumn('due_date')
                ->between(
                    start: now()->startOfYear(),
                    end: now()->endOfYear(),
                )
                ->perMonth()
                ->sum('amount');
            $color = (new ColorGenerator())->fromString($obj->name);
            return [
                'label' => $obj->name,
                'tension' => 0.2,
                'fill' => false,
                'borderColor'  => $color,
                'color' => $color,
                'data' => $trend->map(fn(TrendValue $value) => ((int) $value->aggregate) / 100),
            ];

        })->toArray();

        return [
            'datasets' => $expenses,
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
