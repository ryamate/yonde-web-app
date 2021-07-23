<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ReadRecord extends Model
{
    protected $fillable = [
        'picture_book_id',
        'family_id',
        'user_id',
        'read_date',
        'memo',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo('App\Family');
    }

    public function pictureBook(): BelongsTo
    {
        return $this->belongsTo('App\PictureBook');
    }

    public function children(): BelongsToMany
    {
        return $this->belongsToMany('App\Child')->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
