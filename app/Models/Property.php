<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

final class Property extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'address'];

    protected $casts = [
        'address' => 'json',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_property');
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

    public function expenses(): HasManyThrough
    {
        return $this->hasManyThrough(Expanse::class, Lease::class);
    }
}
