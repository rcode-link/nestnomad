<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\Resources\Expanses\Actions\CreateAction;
use App\Filament\Resources\Expanses\Tables\ExpansesTable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;

final class UnpaidBillsRelationManager extends RelationManager
{
    protected static string $relationship = 'expenses';

    protected static bool $isLazy = false;

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament.charges.tabs.unpaid');
    }

    #[On("refreshReceipts")]
    public function refresh(): void {}

    public function table(Table $table): Table
    {
        return ExpansesTable::configure(
            $table->modifyQueryUsing(fn (Builder $query) => $query->where('is_paid', false))
        )
            ->filters([])
            ->headerActions([
                CreateAction::make($this->ownerRecord),
            ]);
    }
}
