<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Issues\Tables\IssuesTable;
use App\Models\Issues;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

final class IssuesTableWidget extends TableWidget
{
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return  IssuesTable::configure(
            $table->query(
                fn(): Builder => Issues::query()
                    ->whereHas('property', fn($query) => $query->iCanAccess()),
            ),
        );
    }
}
