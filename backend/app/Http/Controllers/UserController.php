<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        // ログインしていない場合、ログインページに遷移する。
        $this->middleware('auth');
    }

    public function show(string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->first();

        return view('users.show', [
            'user' => $user,
        ]);
    }

    public function showSettingProfile(string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->firstOrFail();

        return view('users.show_setting_profile', [
            'user' => $user,
        ]);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        //バリデーション（入力値チェック）
        $validator = Validator::make($request->all(), [
            'yonde_id' => ['required', 'string', 'alpha_num', 'min:3', 'max:16', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'introduction' => ['string', 'max:1000'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        //バリデーションの結果がエラーの場合
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = User::find($request->id);
        $user->yonde_id = $request->yonde_id;
        $user->name = $request->name;
        $user->introduction = $request->introduction;
        $user->email = $request->email;
        if ($request->user_icon != null) {
            $request->user_icon->storeAs('public/user_images', $user->id . '.jpg');
            $user->user_icon = $user->id . '.jpg';
        }
        $user->password = bcrypt($request->password);
        $user->save();

        return view('users.show_setting_profile', [
            'user' => $user,
        ]);
    }
}
