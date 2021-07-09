<?php

namespace App;

use App\Mail\BareMail;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\ContactNotification;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use Notifiable;

    protected $fillable = [
        'nickname',
        'email',
        'name',
        'title',
        'body',
    ];

    // 家族招待通知送信
    public function sendContactNotification()
    {
        $this->notify(new ContactNotification(new BareMail()));
    }
}
