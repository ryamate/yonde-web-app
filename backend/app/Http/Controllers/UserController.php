<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        // ログインしていない場合、ログインページに遷移する。
        $this->middleware('auth');
    }

    /**
     * タイムライン画面表示
     */
    public function show(string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->first();

        $pictureBooks = $user->pictureBooks->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'pictureBooks' => $pictureBooks,
        ]);
    }

    /**
     * 本棚画面表示
     */
    public function bookshelf(string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->first();

        $pictureBooks = $user->pictureBooks->sortByDesc('created_at');

        return view('users.bookshelf', [
            'user' => $user,
            'pictureBooks' => $pictureBooks,
        ]);
    }

    /**
     * いいね画面を表示
     */
    public function likes(string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->first();

        $pictureBooks = $user->likes->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'pictureBooks' => $pictureBooks,
        ]);
    }

    /**
     * フォロー中画面表示
     */
    public function followings(string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->first();

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }

    /**
     * フォロワー画面表示
     */
    public function followers(string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->first();

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    /**
     * フォローする
     */
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

    /**
     * フォロー解除する
     */
    public function unfollow(Request $request, string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['yonde_id' => $yonde_id];
    }

    /**
     * プロフィール設定画面表示
     */
    public function showSettingProfile(string $yonde_id)
    {
        $user = User::where('yonde_id', $yonde_id)->firstOrFail();

        return view('users.show_setting_profile', [
            'user' => $user,
        ]);
    }

    /**
     * プロフィール編集画面表示
     */
    public function edit()
    {
        $user = Auth::user();

        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * プロフィール設定更新する
     */
    public function update(UserRequest $request)
    {
        $user = User::find($request->id);
        $user->yonde_id = $request->yonde_id;
        $user->name = $request->name;
        $user->introduction = $request->introduction;
        $user->email = $request->email;
        if ($request->user_icon != null) {
            $request->user_icon->storeAs('public/user_images', $user->id . '.jpg');
            $user->user_icon = $user->id . '.jpg';
        }
        $user->save();

        return redirect()->route('users.show_setting_profile', [
            'yonde_id' => $user->yonde_id,
        ]);
    }
}
