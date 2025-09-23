<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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
        $query                                    ->whereRaw('(amount = (select sum(payments.amount) from payments where expanse_id = expanses.id) and is_paid = false)');
    }

    public function generatePdf(): void {}


    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

}
