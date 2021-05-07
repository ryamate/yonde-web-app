<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($user_id)
    {
        $user = User::where('id', $user_id)
            ->firstOrFail();

        // テンプレート「user/show.blade.php」を表示する。
        return view('users/show', ['user' => $user]);
    }
}
