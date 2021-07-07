<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PictureBook extends Model
{
    protected $fillable = [
        'family_id',
        'user_id',
        'google_books_id',
        'isbn_13',
        'title',
        'authors',
        'published_date',
        'description',
        'thumbnail_url',
        'five_star_rating',
        'read_status',
        'review',
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo('App\Family');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function readRecords(): HasMany
    {
        return $this->hasMany('App\ReadRecord');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }
}
