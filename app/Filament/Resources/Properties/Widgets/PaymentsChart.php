<?php

namespace App\Filament\Resources\Properties\Widgets;

use App\Models\{Expanse, Payment};
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\{Trend, TrendValue};

final class PaymentsChart extends ChartWidget
{
    protected ?string $heading = 'Payments Chart';

    protected function getData(): array
    {
        $expenses = Trend::model(Expanse::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('amount');
        $payments = Trend::model(Payment::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('amount');

        return ['datasets' => [
            [
                'label' => 'Requested payments',
                'tension' => 0.2,
                'fill' => false,
                'borderColor'  => 'rgb(75, 192, 192)',
                'data' => $expenses->map(fn(TrendValue $value) => ((int) $value->aggregate) / 100),
            ],
            [
                'label' => 'Pamyents',
                'tension' => 0.2,
                'fill' => false,
                'borderColor'  => 'var(--success-800)',
                'data' => $payments->map(fn(TrendValue $value) => ((int) $value->aggregate) / 100),
            ],

        ],

            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],  ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
