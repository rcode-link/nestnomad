<?php

namespace App\Filament\Resources\Expanses\Actions;

use App\Models\Expanse;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Icons\Heroicon;

final class ViewAction
{
    public static function infolist(): Action
    {
        return Action::make("view")
            ->icon(Heroicon::Eye)
            ->schema([
                TextEntry::make('amount')
                    ->icon(fn(Expanse $record) => $record->getFirstMedia('bill') ? Heroicon::Link : null)
                    ->url(fn(Expanse $record) => $record->getFirstMedia('bill')?->getTemporaryUrl(now()->addMinutes(5)))
                    ->openUrlInNewTab(),
            ])->slideOver(true);
    }
}
