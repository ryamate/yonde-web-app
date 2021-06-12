<?php

namespace App\Http\Controllers;

use App\Family;
use App\User;
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
    public function showSetting(string $family_id)
    {
        $family = Family::with('users')->where('id', $family_id)->first();
        $user = User::where('id', Auth::id())->firstOrFail();
        $familyUsers = $family->users->whereNotIn('id', $user->id)->sortBy('created_at');

        return view('families.show_setting', [
            'user' => $user,
            'family' => $family,
            'familyUsers' => $familyUsers,
        ]);
    }

    /**
     * 家族設定編集画面表示
     */
    public function edit()
    {
        $family = Family::where('id', Auth::user()->family_id)->first();

        return view('families.edit', [
            'family' => $family,
        ]);
    }

    /**
     * 家族設定を更新する
     */
    public function update(FamilyRequest $request)
    {
        $family = Family::find($request->id);
        $family->fill($request->all());
        $family->save();

        return redirect()->route('families.show_setting', [
            'id' => Auth::user()->family_id,
        ]);
    }
}
