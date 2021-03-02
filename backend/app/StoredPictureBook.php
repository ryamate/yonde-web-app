<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoredPictureBook extends Model
{
    public function pictureBook(): BelongsTo
    {
        return $this->belongsTo('App\PictureBook');
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo('App\Family');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
