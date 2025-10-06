<?php

namespace App\Filament\Resources;

use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

final class LanguageSwitcher
{
    public static function make(): Action
    {
        return Action::make('language-switcher')
            ->label(config('app.available_locales')[App::getLocale()] ?? 'Language')
            ->icon('heroicon-o-language')
            ->form([
                Select::make('locale')
                    ->label(__('filament.common.language'))
                    ->options(config('app.available_locales'))
                    ->default(Session::get('locale', App::getLocale()))
                    ->required(),
            ])
            ->action(function (array $data) {
                Session::put('locale', $data['locale']);

                Notification::make()
                    ->title(__('filament.common.messages.language_changed'))
                    ->success()
                    ->send();

                // Use a proper redirect that won't conflict with Livewire
                return redirect()->to('/app');
            });
    }
}
