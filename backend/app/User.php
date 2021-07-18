<?php

namespace App;

use App\Mail\BareMail;
use App\Notifications\VerifyEmailNotification;
use App\Notifications\PasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    use SoftDeletes;

    protected $table = 'users';
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nickname',
        'email',
        'email_verified_at',
        'password',
        'family_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // メールアドレス認証通知送信
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification(new BareMail()));
    }

    // パスワードリセット通知送信
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token, new BareMail()));
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo('App\Family');
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
        return $this->belongsToMany('App\Family', 'follows')->withTimestamps();
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\PictureBook', 'likes')->withTimestamps();
    }

    public function getCountFollowsAttribute(): int
    {
        return $this->follows->count();
    }
}
