<?php

namespace App\Filament\Resources\Issues;

use App\Filament\Resources\Issues\Pages\CreateIssues;
use App\Filament\Resources\Issues\Pages\EditIssues;
use App\Filament\Resources\Issues\Pages\ListIssues;
use App\Filament\Resources\Issues\Pages\ViewIssues;
use App\Filament\Resources\Issues\Schemas\IssuesForm;
use App\Filament\Resources\Issues\Schemas\IssuesInfolist;
use App\Filament\Resources\Issues\Tables\IssuesTable;
use App\Models\Issues;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

final class IssuesResource extends Resource
{
    protected static ?string $model = Issues::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBugAnt;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return IssuesForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return IssuesInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IssuesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIssues::route('/'),
            'create' => CreateIssues::route('/create'),
            'view' => ViewIssues::route('/{record}'),
            'edit' => EditIssues::route('/{record}/edit'),
        ];
    }
}
