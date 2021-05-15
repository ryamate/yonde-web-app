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

        $storedPictureBooks = $user->storedPictureBooks->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'storedPictureBooks' => $storedPictureBooks,
        ]);
    }

    public function bookshelf(string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->first();

        $storedPictureBooks = $user->storedPictureBooks->sortByDesc('created_at');

        return view('users.bookshelf', [
            'user' => $user,
            'storedPictureBooks' => $storedPictureBooks,
        ]);
    }

    public function likes(string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->first();

        $storedPictureBooks = $user->likes->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'storedPictureBooks' => $storedPictureBooks,
        ]);
    }

    public function followings(string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->first();

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }

    public function followers(string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->first();

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function follow(Request $request, string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['yonde_id' => $yonde_id];
    }

    public function unfollow(Request $request, string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['yonde_id' => $yonde_id];
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

        return redirect()->route('users.show_setting_profile', [
            'yonde_id' => $user->yonde_id,
        ]);
    }
}
