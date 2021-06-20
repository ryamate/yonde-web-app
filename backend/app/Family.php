<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    protected $fillable = [
        'name',
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

    public function isStoredBy($searchedBook): bool
    {
        return $searchedBook
            ? (bool)$this->pictureBooks->where('google_books_id', $searchedBook->id)->count()
            : false;
    }
}
