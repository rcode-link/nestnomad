<?php

namespace App\Enums;

enum DayOfWeek: int
{
    case SUNDAY = 0;
    case MONDAY = 1;
    case TUESDAY = 2;
    case WEDNESDAY = 3;
    case THURSDAY = 4;
    case FRIDAY = 5;
    case SATURDAY = 6;

    public function getLabel(): string
    {
        return match ($this) {
            self::SUNDAY => __('days.sunday'),
            self::MONDAY => __('days.monday'),
            self::TUESDAY => __('days.tuesday'),
            self::WEDNESDAY => __('days.wednesday'),
            self::THURSDAY => __('days.thursday'),
            self::FRIDAY => __('days.friday'),
            self::SATURDAY => __('days.saturday'),
        };
    }

    public function getShortLabel(): string
    {
        return match ($this) {
            self::SUNDAY => __('days.short.sun'),
            self::MONDAY => __('days.short.mon'),
            self::TUESDAY => __('days.short.tue'),
            self::WEDNESDAY => __('days.short.wed'),
            self::THURSDAY => __('days.short.thu'),
            self::FRIDAY => __('days.short.fri'),
            self::SATURDAY => __('days.short.sat'),
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

    public static function getShortOptions(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->getShortLabel();
        }
        return $options;
    }
}