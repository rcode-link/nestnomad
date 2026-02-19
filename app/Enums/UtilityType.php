<?php

namespace App\Enums;

enum UtilityType: string
{
    case ELECTRICITY = 'electricity';
    case WATER = 'water';
    case GAS = 'gas';
    case INTERNET = 'internet';
    case HEATING = 'heating';
    case COOLING = 'cooling';
    case TV = 'tv';
    case TRASH = 'trash';
    case PHONE = 'phone';
    case OTHER = 'other';

    public function getLabel(): string
    {
        return __('filament.charges.utilities.' . $this->value);
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::ELECTRICITY => 'heroicon-o-bolt',
            self::WATER       => 'heroicon-o-beaker',
            self::GAS         => 'heroicon-o-fire',
            self::INTERNET    => 'heroicon-o-wifi',
            self::HEATING     => 'heroicon-o-sun',
            self::COOLING     => 'heroicon-o-cloud',
            self::TV          => 'heroicon-o-tv',
            self::TRASH       => 'heroicon-o-trash',
            self::PHONE       => 'heroicon-o-phone',
            self::OTHER       => 'heroicon-o-ellipsis-horizontal',
        };
    }

    public static function getOptions(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->getLabel();
        }

        return $options;
    }
}
