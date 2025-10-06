<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class RecurringCharges extends Model
{
    protected $fillable = [
        'lease_id',
        'interval',
        'interval_at',
        'execute_at',
        'title',
        'description',
        'amount',
    ];
}
