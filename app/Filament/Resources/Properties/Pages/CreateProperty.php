<?php

namespace App\Filament\Resources\Properties\Pages;

use App\Filament\Resources\Properties\PropertyResource;
use Exception;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class CreateProperty extends CreateRecord
{
    protected static string $resource = PropertyResource::class;

    public function getTitle(): string
    {
        return __('filament.properties.pages.create');
    }

    protected function handleRecordCreation(array $data): Model
    {
        try {
            DB::beginTransaction();
            $model = static::getModel()::create($data);
            $model->users()->attach(auth()->id());
            DB::commit();
            return $model;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;

        }
    }


}
