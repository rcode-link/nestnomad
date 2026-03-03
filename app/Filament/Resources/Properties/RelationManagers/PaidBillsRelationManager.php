<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\Resources\Expanses\Tables\ExpansesTable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;

final class PaidBillsRelationManager extends RelationManager
{
    protected static string $relationship = 'expenses';

    protected static bool $isLazy = false;

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament.charges.tabs.paid');
    }

    #[On("refreshReceipts")]
    public function refresh(): void {}

    public function table(Table $table): Table
    {
        return ExpansesTable::configure(
            $table->modifyQueryUsing(fn (Builder $query) => $query->where('is_paid', true))
        )
            ->filters([]);
    }
}
