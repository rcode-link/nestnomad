<?php

namespace App\Enums;

enum ChargeCategory: string
{
    case RENT = 'rent';
    case UTILITIES = 'utilities';
    case MAINTENANCE = 'maintenance';
    case PARKING = 'parking';
    case CLEANING = 'cleaning';
    case LATE_FEE = 'late_fee';
    case DEPOSIT = 'deposit';
    case OTHER = 'other';

    public function getLabel(): string
    {
        return match ($this) {
            self::RENT => __('filament.charges.categories.rent'),
            self::UTILITIES => __('filament.charges.categories.utilities'),
            self::MAINTENANCE => __('filament.charges.categories.maintenance'),
            self::PARKING => __('filament.charges.categories.parking'),
            self::CLEANING => __('filament.charges.categories.cleaning'),
            self::LATE_FEE => __('filament.charges.categories.late_fee'),
            self::DEPOSIT => __('filament.charges.categories.deposit'),
            self::OTHER => __('filament.charges.categories.other'),
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::RENT => 'success',
            self::UTILITIES => 'info',
            self::MAINTENANCE => 'warning',
            self::PARKING => 'primary',
            self::CLEANING => 'secondary',
            self::LATE_FEE => 'danger',
            self::DEPOSIT => 'gray',
            self::OTHER => 'slate',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::RENT => 'heroicon-o-home',
            self::UTILITIES => 'heroicon-o-bolt',
            self::MAINTENANCE => 'heroicon-o-wrench-screwdriver',
            self::PARKING => 'heroicon-o-truck',
            self::CLEANING => 'heroicon-o-sparkles',
            self::LATE_FEE => 'heroicon-o-exclamation-triangle',
            self::DEPOSIT => 'heroicon-o-shield-check',
            self::OTHER => 'heroicon-o-ellipsis-horizontal',
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

    public static function getOptionsWithIcons(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = [
                'label' => $case->getLabel(),
                'icon' => $case->getIcon(),
                'color' => $case->getColor(),
            ];
        }
        return $options;
    }
}