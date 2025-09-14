<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Payment extends Model
{
    protected $fillable = [
        "amount",
        "expanse_id",
    ];

}
