<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class Comment extends Model
{
    protected $fillable = [
        'text',
        'commentable_id',
        'commentable_type',
        'commenter_id',
        'commenter_type',
    ];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function commenter(): MorphTo
    {
        return $this->morphTo();
    }
}
