<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserPropertyRelation: string implements HasLabel
{
    case owner = "owner";
    case tenant = "tenant";

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array|bool
    {
        $values = [];
        foreach (self::names() as $str) {
            $values[$str] = __($str);
        }

        return $values;
    }

    public function getLabel(): string
    {
        return __($this->name);
    }

}
