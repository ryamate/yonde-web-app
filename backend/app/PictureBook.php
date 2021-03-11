<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PictureBook extends Model
{
    protected $fillable = [
        'google_books_id',
        'isbn_13',
        'title',
        'authors',
        'thumbnail_uri',
    ];

    public function storedPictureBook(): HasMany
    {
        return $this->hasMany('App\StoredPictureBook');
    }

    public function isStoredBy(?User $user): bool
    {
        return $user
            ? (bool)$this->stored_picture_books->where('id', $user->id)->count()
            : false;
    }
}
