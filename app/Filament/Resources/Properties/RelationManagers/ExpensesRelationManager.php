<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\Resources\Expanses\Actions\CreateAction;
use App\Filament\Resources\Expanses\Tables\ExpansesTable;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;

final class ExpensesRelationManager extends RelationManager
{
    protected static string $relationship = 'expenses';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament.common.relations.charges');
    }

    #[On("refreshReceipts")]
    public function refresh(): void {}

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament.charges.fields.description'))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {


        return $schema
            ->components([
                TextEntry::make('name'),
            ]);
    }

    public function table(Table $table): Table
    {
        return ExpansesTable::configure($table)->headerActions([
            CreateAction::make($this->ownerRecord),
        ]);

    }
}
