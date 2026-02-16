<?php

namespace App\Models;

use Database\Factories\IssuesFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int $id
 * @property int $user_id
 * @property int $property_id
 * @property string $title
 * @property array<array-key, mixed> $content
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Property $property
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\IssuesFactory factory($count = null, $state = [])
 * @method static Builder<static>|Issues myIssues()
 * @method static Builder<static>|Issues newModelQuery()
 * @method static Builder<static>|Issues newQuery()
 * @method static Builder<static>|Issues query()
 * @method static Builder<static>|Issues whereContent($value)
 * @method static Builder<static>|Issues whereCreatedAt($value)
 * @method static Builder<static>|Issues whereId($value)
 * @method static Builder<static>|Issues wherePropertyId($value)
 * @method static Builder<static>|Issues whereStatus($value)
 * @method static Builder<static>|Issues whereTitle($value)
 * @method static Builder<static>|Issues whereUpdatedAt($value)
 * @method static Builder<static>|Issues whereUserId($value)
 * @mixin \Eloquent
 */
final class Issues extends Model implements HasMedia
{
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

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

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
