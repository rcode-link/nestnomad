<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int $id
 * @property int $lease_id
 * @property string|null $name
 * @property int $amount
 * @property int $is_private
 * @property int $is_paid
 * @property string $due_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $description
 * @property-read \App\Models\Lease $lease
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payment
 * @property-read int|null $payment_count
 * @method static Builder<static>|Expanse newModelQuery()
 * @method static Builder<static>|Expanse newQuery()
 * @method static Builder<static>|Expanse pendingVerification()
 * @method static Builder<static>|Expanse query()
 * @method static Builder<static>|Expanse whereAmount($value)
 * @method static Builder<static>|Expanse whereCreatedAt($value)
 * @method static Builder<static>|Expanse whereDescription($value)
 * @method static Builder<static>|Expanse whereDueDate($value)
 * @method static Builder<static>|Expanse whereId($value)
 * @method static Builder<static>|Expanse whereIsPaid($value)
 * @method static Builder<static>|Expanse whereIsPrivate($value)
 * @method static Builder<static>|Expanse whereLeaseId($value)
 * @method static Builder<static>|Expanse whereName($value)
 * @method static Builder<static>|Expanse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class Expanse extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'expanses';

    protected $fillable = [
        'name',
        'amount',
        'lease_id',
        'created_at',
        'updated_at',
        'is_paid',
        'due_date',
        'description',
    ];

    public function lease()
    {
        return $this->belongsTo(Lease::class, 'lease_id');
    }

    #[Scope]
    public function pendingVerification(Builder $query): void
    {
        $query->whereRaw('(amount = (select sum(payments.amount) from payments where expanse_id = expanses.id) and is_paid = false)');
    }

    public function generatePdf(): void {}


    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

}
