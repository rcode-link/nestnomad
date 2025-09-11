<?php

namespace App\Examples;

use App\Enums\ChargeCategory;
use App\Enums\ChargeStatus;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

/**
 * This file demonstrates how to use the ChargeCategory and ChargeStatus enums
 * in various Filament components throughout your application.
 */
class ChargeEnumUsage
{
    /**
     * Example: Basic dropdown in forms
     */
    public static function categoryDropdown(): Select
    {
        return Select::make('category')
            ->label(__('filament.charges.fields.category'))
            ->options(ChargeCategory::getOptions())
            ->default(ChargeCategory::RENT->value)
            ->required();
    }

    /**
     * Example: Status dropdown in forms
     */
    public static function statusDropdown(): Select
    {
        return Select::make('status')
            ->label(__('filament.charges.fields.status'))
            ->options(ChargeStatus::getOptions())
            ->default(ChargeStatus::PENDING->value)
            ->required();
    }

    /**
     * Example: Category column with badge, color, and icon
     */
    public static function categoryColumn(): TextColumn
    {
        return TextColumn::make('category')
            ->label(__('filament.charges.fields.category'))
            ->badge()
            ->formatStateUsing(fn (?string $state): string => 
                $state ? ChargeCategory::from($state)->getLabel() : '-'
            )
            ->color(fn (?string $state): string => 
                $state ? ChargeCategory::from($state)->getColor() : 'gray'
            )
            ->icon(fn (?string $state): string => 
                $state ? ChargeCategory::from($state)->getIcon() : 'heroicon-o-question-mark-circle'
            );
    }

    /**
     * Example: Status column with badge, color, and icon
     */
    public static function statusColumn(): TextColumn
    {
        return TextColumn::make('status')
            ->label(__('filament.charges.fields.status'))
            ->badge()
            ->formatStateUsing(fn (?string $state): string => 
                $state ? ChargeStatus::from($state)->getLabel() : '-'
            )
            ->color(fn (?string $state): string => 
                $state ? ChargeStatus::from($state)->getColor() : 'gray'
            )
            ->icon(fn (?string $state): string => 
                $state ? ChargeStatus::from($state)->getIcon() : 'heroicon-o-question-mark-circle'
            );
    }

    /**
     * Example: Filter by category
     */
    public static function categoryFilter(): SelectFilter
    {
        return SelectFilter::make('category')
            ->label(__('filament.charges.fields.category'))
            ->options(ChargeCategory::getOptions());
    }

    /**
     * Example: Filter by status
     */
    public static function statusFilter(): SelectFilter
    {
        return SelectFilter::make('status')
            ->label(__('filament.charges.fields.status'))
            ->options(ChargeStatus::getOptions());
    }

    /**
     * Example: Get all rent-related charges
     */
    public static function getRentCharges($query)
    {
        return $query->where('category', ChargeCategory::RENT->value);
    }

    /**
     * Example: Get all unpaid charges
     */
    public static function getUnpaidCharges($query)
    {
        return $query->whereIn('status', [
            ChargeStatus::PENDING->value,
            ChargeStatus::OVERDUE->value
        ]);
    }

    /**
     * Example: Get enum information for API responses
     */
    public static function getCategoryInfo(string $category): array
    {
        $enum = ChargeCategory::from($category);
        
        return [
            'value' => $enum->value,
            'label' => $enum->getLabel(),
            'color' => $enum->getColor(),
            'icon' => $enum->getIcon(),
        ];
    }

    /**
     * Example: Get all categories with their information
     */
    public static function getAllCategoriesWithInfo(): array
    {
        return ChargeCategory::getOptionsWithIcons();
    }

    /**
     * Example: Get all statuses with their information
     */
    public static function getAllStatusesWithInfo(): array
    {
        return ChargeStatus::getOptionsWithIcons();
    }
}