<?php

namespace App;

use App\Mail\BareMail;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\InvitationFamilyNotification;
use Illuminate\Notifications\Notifiable;

class Invite extends Model
{
    use Notifiable;

    protected $fillable = [
        'family_id',
        'email',
        'token',
    ];

    // 家族招待通知送信
    public function sendInvitationFamilyNotification($token)
    {
        $this->notify(new InvitationFamilyNotification($token, new BareMail()));
    }
}
