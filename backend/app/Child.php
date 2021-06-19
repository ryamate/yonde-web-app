<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function readRecords(): BelongsToMany
    {
        return $this->belongsToMany('App\ReadRecord')->withTimestamps();
    }
}
