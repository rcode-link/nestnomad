<?php

namespace App\Models;

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

    public function property(): BelongsTo
    {

        return $this->belongsTo(Property::class);
    }
}
