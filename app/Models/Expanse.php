<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
    ];

    public function lease()
    {
        return $this->belongsTo(Lease::class, 'lease_id');
    }


    public function generatePdf(): void {}

}
