<?php

namespace App\Filament\Resources\Leases\Pages;

use App\Filament\Resources\Leases\LeaseResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

final class CreateLease extends CreateRecord
{
    protected static string $resource = LeaseResource::class;

    public function getTitle(): string
    {
        return __('filament.leases.pages.create');
    }


    //protected function handleRecordCreation(array $data): Model
    //{


    //    $data['tenant_name'] = "Random";
    //    $model = static::getModel()::create($data);
    //    $users = collect($data['user'])
    //        ->map(fn($arr) => array_merge($arr, ['lease_id' => $model->id]))
    //        ->toArray();
    //    $model->user()->insert($users);
    //    return $model;
    //}

}
