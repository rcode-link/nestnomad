<?php

namespace App\Models;

use Database\Factories\PropertyFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property int $id
 * @property string $name
 * @property array<array-key, mixed> $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Expanse> $expenses
 * @property-read int|null $expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Issues> $issues
 * @property-read int|null $issues_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Lease> $lease
 * @property-read int|null $lease_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\PropertyFactory factory($count = null, $state = [])
 * @method static Builder<static>|Property iCanAccess()
 * @method static Builder<static>|Property myProperty()
 * @method static Builder<static>|Property newModelQuery()
 * @method static Builder<static>|Property newQuery()
 * @method static Builder<static>|Property query()
 * @method static Builder<static>|Property whereAddress($value)
 * @method static Builder<static>|Property whereCreatedAt($value)
 * @method static Builder<static>|Property whereId($value)
 * @method static Builder<static>|Property whereName($value)
 * @method static Builder<static>|Property whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class Property extends Model implements HasMedia
{
    /** @use HasFactory<PropertyFactory> */
    use HasFactory;

    use InteractsWithMedia;

    protected $fillable = [
        'name', 'address', 'public',
        'floor', 'size', 'rooms', 'bathrooms', 'heating',
        'furnished', 'parking', 'elevator', 'balcony',
        'year_built', 'description',
    ];

    protected $casts = [
        'address' => 'json',
        'furnished' => 'boolean',
        'parking' => 'boolean',
        'elevator' => 'boolean',
        'balcony' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
            ->registerMediaConversions(function (Media $media): void {
                $this->addMediaCollection('thumb')
                    ->width(300);
            });
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_property')->withPivot('role');
    }

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_property')->withPivot('role')->wherePivot('role', 'owner');
    }

    public function managers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_property')->withPivot('role')->wherePivot('role', 'manager');
    }

    public function lease(): HasMany
    {
        return $this->hasMany(Lease::class);
    }

    #[Scope]
    public function myProperty(Builder $builder)
    {
        return $builder->whereHas('users', fn(Builder $query) => $query->where('user_id', auth()->id()));
    }

    #[Scope]
    public function iCanAccess(Builder $builder)
    {
        return $builder
            ->whereIn('id', auth()->user()->myPropertieIds());
        //->with('users', 'lease')
        //->whereHas(
        //    'users',
        //    fn(Builder $query) => $query->where('user_id', auth()->id()),
        //)
        //->orWhereHas(
        //    'lease',
        //    fn(Builder $query) => $query->where('user_id', auth()->id()),
        //);
    }





    public function expenses(): HasManyThrough
    {
        return $this->hasManyThrough(Expanse::class, Lease::class);
    }

    public function issues(): HasMany
    {
        return $this->hasMany(Issues::class);
    }
}
