<?php

namespace App\Filament\Resources\Properties\Pages;

use App\Filament\Resources\Properties\PropertyResource;
use App\Filament\Resources\Properties\RelationManagers\ManagersRelationManager;
use App\Filament\Resources\Properties\RelationManagers\TenantsRelationManager;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewProperty extends ViewRecord
{
    protected static string $resource = PropertyResource::class;

    public function getTitle(): string
    {
        return __('filament.properties.pages.view');
    }

    public function getRelationManagers(): array
    {
        return collect(parent::getRelationManagers())
            ->reject(fn ($manager) => in_array($manager, [
                ManagersRelationManager::class,
                TenantsRelationManager::class,
            ]))
            ->all();
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
