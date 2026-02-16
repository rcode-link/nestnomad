<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\Checkbox;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

final class Register extends BaseRegister
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                Checkbox::make('terms')
                    ->label(new HtmlString(
                        __('filament.register.terms', [
                            'terms_url' => route('terms'),
                            'privacy_url' => route('privacy'),
                        ])
                    ))
                    ->accepted()
                    ->validationMessages([
                        'accepted' => __('filament.register.terms_required'),
                    ]),
            ]);
    }
}
