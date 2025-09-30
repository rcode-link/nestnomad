<?php

namespace App\Models;

use Database\Factories\IssuesFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LakM\Commenter\Concerns\Commentable;
use LakM\Commenter\Contracts\CommentableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

final class Issues extends Model implements CommentableContract, HasMedia
{
    use Commentable;
    /* @use HasFactory<IssuesFactory>*/
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'property_id',
        'status',
        'title',
        'content',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }


    #[Scope]
    public function myIssues(Builder $builder)
    {
        return $builder->whereHas('property', fn(Builder $query) => $query->iCanAccess());
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {

        return [
            'content' => 'array',
        ];

    }

}
