<?php

namespace App\Enums;

enum IssueStatus: string
{
    case OPEN = 'open';
    case RESOLVING = 'resolving';
    case WAITING = 'waiting';
    case DONE = 'done';


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

    public function getIcon()
    {
        return match ($this) {
            self::OPEN => 'heroicon-o-inbox',
            self::RESOLVING => 'heroicon-o-wrench-screwdriver',
            self::WAITING => 'heroicon-o-clock',
            self::DONE => 'heroicon-o-archive-box',
            default => 'heroicon-o-inbox',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::OPEN => __('common.open'),
            self::RESOLVING => __('common.in_progress'),
            self::WAITING => __('common.postponed'),
            self::DONE => __('common.done'),
            default => __('common.open'),
        };
    }
    public function getColor(): string
    {
        return match ($this) {
            self::OPEN => 'danger',
            self::RESOLVING => 'warning',
            self::WAITING => 'info',
            self::DONE => 'success',
            default => 'danger',
        };
    }

}
