<?php

namespace App\Models;

use Database\Factories\UserLeaseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string $tenant_name
 * @property int $lease_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserLeaseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLease newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLease newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLease query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLease whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLease whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLease whereLeaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLease whereTenantName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLease whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLease whereUserId($value)
 * @mixin \Eloquent
 */
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
