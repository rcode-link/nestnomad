<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $lease_id
 * @property string $interval
 * @property string $interval_at
 * @property string $execute_at
 * @property string $title
 * @property string|null $description
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges whereExecuteAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges whereIntervalAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges whereLeaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges whereUpdatedAt($value)
 * @property int $due_date_in_days
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecurringCharges whereDueDateInDays($value)
 * @mixin \Eloquent
 */
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
        'due_date_in_days',
    ];

    public function lease(): BelongsTo
    {
        return $this->belongsTo(Lease::class);
    }
}
