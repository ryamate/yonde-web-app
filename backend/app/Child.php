<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Child extends Model
{
    protected $fillable = [
        'name',
        'gender_code',
        'birthday',
        'family_id',
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo('App\Family');
    }
}
