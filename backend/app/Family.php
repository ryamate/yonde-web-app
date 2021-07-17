<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Family extends Model
{
    protected $fillable = [
        'name',
        'nickname',
        'introduction',
    ];

    public function users(): HasMany
    {
        return $this->hasMany('App\User');
    }

    public function children(): HasMany
    {
        return $this->hasMany('App\Child');
    }

    public function pictureBooks(): HasMany
    {
        return $this->hasMany('App\PictureBook');
    }

    public function readRecords(): HasMany
    {
        return $this->hasMany('App\ReadRecord');
    }

    public function follows(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'follows')->withTimestamps();
    }

    public function isFollowedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->follows->where('id', $user->id)->count()
            : false;
    }

    public function getCountFollowsAttribute(): int
    {
        return $this->follows->count();
    }

    public function isStoredBy($searchedBook): bool
    {
        return $searchedBook
            ? (bool)$this->pictureBooks->where('google_books_id', $searchedBook->id)->count()
            : false;
    }
}
