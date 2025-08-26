<?php

namespace App\Models;

use App\Enums\UserPropertyRelation;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

final class Property extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'address'];

    protected $casts = [
        'address' => 'json',
    ];

    public function tenants(): BelongsToMany
    {
        return $this->users()->where('relation', UserPropertyRelation::tenant);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_property')->using(UserProperty::class);
    }

    #[Scope]
    public function myProperty(Builder $builder)
    {
        return $builder->whereHas('users', fn(Builder $query) => $query->where('user_id', auth()->id())
            ->where('relation', UserPropertyRelation::owner));
    }
}
