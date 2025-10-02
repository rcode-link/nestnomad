<?php

namespace App\Models;

use Database\Factories\UserLeaseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class UserLease extends Model
{
    /** @use HasFactory<UserLeaseFactory> */
    use HasFactory;



    protected $fillable = [
        'user_id',
        'lease_id',
        'tenant_name',
    ];

}
