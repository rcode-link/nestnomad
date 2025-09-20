<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Lease extends Model
{
    protected $fillable = [
        'property_id',
        'user_id',
        'start_of_lease',
        'end_of_lease',
        'tenant_name',
        'contract',
    ];

    protected $casts = [
        'contract' => 'json',
    ];

    #[Scope]
    public function active(Builder $builder): void
    {
        $builder->where('end_of_lease', '<', now())->orWhere('end_of_lease', null);
    }

    public function property(): BelongsTo
    {

        return $this->belongsTo(Property::class);
    }

    #[Scope]
    public function propertyOwner(Builder $query): void
    {
        $query->whereHas('property', fn($builder) => $builder->myProperty());
    }

    #[Scope]
    public function myLease(Builder $query): void
    {
        $query->propertyOwner()->orWhere('user_id', auth()->id());
    }
}
