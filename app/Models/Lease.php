<?php

namespace App\Models;

use Database\Factories\LeaseFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $property_id
 * @property string $start_of_lease
 * @property string|null $end_of_lease
 * @property array<array-key, mixed>|null $contract
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Expanse> $expanse
 * @property-read int|null $expanse_count
 * @property-read \App\Models\Property $property
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RecurringCharges> $recurringCharges
 * @property-read int|null $recurring_charges_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserLease> $user
 * @property-read int|null $user_count
 * @method static Builder<static>|Lease active()
 * @method static \Database\Factories\LeaseFactory factory($count = null, $state = [])
 * @method static Builder<static>|Lease myLease()
 * @method static Builder<static>|Lease newModelQuery()
 * @method static Builder<static>|Lease newQuery()
 * @method static Builder<static>|Lease propertyOwner()
 * @method static Builder<static>|Lease query()
 * @method static Builder<static>|Lease whereContract($value)
 * @method static Builder<static>|Lease whereCreatedAt($value)
 * @method static Builder<static>|Lease whereEndOfLease($value)
 * @method static Builder<static>|Lease whereId($value)
 * @method static Builder<static>|Lease wherePropertyId($value)
 * @method static Builder<static>|Lease whereStartOfLease($value)
 * @method static Builder<static>|Lease whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class Lease extends Model
{
    /** @use HasFactory<LeaseFactory> */
    use HasFactory, SoftDeletes;


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
