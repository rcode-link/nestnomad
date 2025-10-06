<?php

namespace App\Models;

use Database\Factories\LeaseFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Lease extends Model
{
    /** @use HasFactory<LeaseFactory> */
    use HasFactory;


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

    public function user(): HasMany
    {
        return $this->hasMany(UserLease::class);
    }

    #[Scope]
    public function active(Builder $builder): void
    {
        $builder->where('end_of_lease', '<', now())->orWhere('end_of_lease', null);
    }

    public function property(): BelongsTo
    {

        return $this->belongsTo(Property::class);
    }

    public function expanse(): HasMany
    {

        return $this->hasMany(Expanse::class);
    }

    #[Scope]
    public function propertyOwner(Builder $query): void
    {
        $query->whereHas('property', fn($builder) => $builder->myProperty());
    }

    #[Scope]
    public function myLease(Builder $query): void
    {
        $query->whereHas('property', fn($builder) => $builder->iCanAccess());
    }

    public function recurringCharges()
    {
        return $this->hasMany(RecurringCharges::class);
    }
}
