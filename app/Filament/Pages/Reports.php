<?php

namespace App\Filament\Pages;

use App\Filament\Resources\Properties\Widgets\PaymentsChart;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

final class Reports extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected string $view = 'filament.pages.reports';

    public static function getNavigationLabel(): string
    {
        return __('filament.reports.title');
    }

    public function getTitle(): string
    {
        return __('filament.reports.title');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PaymentsChart::class,
        ];
    }
}
