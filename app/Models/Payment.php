<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

final class Payment extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        "amount",
        "expanse_id",
    ];

}
