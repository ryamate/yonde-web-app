<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoredPictureBook extends Model
{
    protected $fillable = [
        'picture_book_id',
        'user_id',
        'five_star_rating',
        'read_status',
        'summary',
    ];

    public function pictureBook(): BelongsTo
    {
        return $this->belongsTo('App\PictureBook');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
