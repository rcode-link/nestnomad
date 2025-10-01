<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class UserLease extends Model
{
    protected $fillable = [
        'user_id',
        'lease_id',
        'tenant_name',
    ];

}
