<?php

namespace App\Http\Controllers;

use App\Family;
use App\PictureBook;
use Storage;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\FamilyRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class FamilyController extends Controller
{
    public function __construct()
    {
        // ログインしていない場合、ログインページに遷移する。
        $this->middleware('auth');
    }

    /**
     * 家族のタイムライン画面表示
     */
    public function index(string $family_id)
    {
        $family = Family::where('id', $family_id)->first();

        $pictureBooks = PictureBook::where('family_id', $family_id)->orderBy('updated_at', 'DESC')->paginate(5);


        return view('families.index', [
            'family' => $family,
            'pictureBooks' => $pictureBooks,
        ]);
    }

    /**
     * 家族の本棚画面表示
     */
    public function bookshelf(string $family_id)
    {
        $family = Family::where('id', $family_id)->first();

        $pictureBooks = PictureBook::where('family_id', $family_id)->orderBy('updated_at', 'DESC')->get();

        return view('families.bookshelf', [
            'family' => $family,
            'pictureBooks' => $pictureBooks,
        ]);
    }

    // /**
    //  * フォロワー画面表示
    //  */
    // public function followers(string $name)
    // {
    //     $user = User::where('name', $name)->first();

    //     $followers = $user->followers->sortByDesc('created_at');

    //     return view('users.followers', [
    //         'user' => $user,
    //         'followers' => $followers,
    //     ]);
    // }

    /**
     * 家族設定画面表示
     */
    public function showSettingFamily(string $name)
    {
        // $user = User::where('name', $name)->firstOrFail();

        // return view('users.show_setting_profile', [
        //     'user' => $user,
        // ]);
    }

    /**
     * 家族設定編集画面表示
     */
    public function edit()
    {
        // $user = Auth::user();

        // return view('users.edit', [
        //     'user' => $user,
        // ]);
    }

    /**
     * 家族設定を更新する
     */
    public function update(Request $request)
    {
        // $user = User::find($request->id);
        // $user->name = $request->name;
        // $user->nickname = $request->nickname;
        // $user->relation = $request->relation;
        // if ($user->email !== $request->email) {
        //     $user->email_verified_at = null;
        //     $user->email = $request->email;
        // }

        // // 画像ファイルのアップロード
        // if ($request->image != null) {
        //     $image = $request->file('image');
        //     if (app()->isLocal() || app()->runningUnitTests()) {
        //         // 開発環境
        //         $path = $image->storeAs('public/user_images', $user->id . '.jpg');
        //         $user->icon_path = Storage::url($path);
        //     } else {
        //         // 本番環境
        //         $path = Storage::disk('s3')->put('/', $image, 'public');
        //         $user->icon_path = Storage::disk('s3')->url($path);
        //     }
        // }

        // $user->save();

        // return redirect()->route('users.show_setting_profile', [
        //     'name' => $user->name,
        // ]);
    }
}
