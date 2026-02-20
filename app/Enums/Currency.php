<?php

namespace App\Enums;

enum Currency: string
{
    case BAM = 'BAM';
    case EUR = 'EUR';
    case USD = 'USD';
    case RSD = 'RSD';

    public function getLabel(): string
    {
        return match ($this) {
            self::BAM => 'BAM',
            self::EUR => 'EUR',
            self::USD => 'USD',
            self::RSD => 'RSD',
        };
    }

    public static function getOptions(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn(self $case) => [$case->value => $case->getLabel()])
            ->all();
    }
}
