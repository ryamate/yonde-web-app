<?php

namespace App\Http\Controllers;

use App\User;
use App\Family;
use App\PictureBook;
use App\ReadRecord;
use Storage;
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
     * ユーザーのページ画面表示
     */
    public function index(string $name)
    {
        $data = $this->collectUserInfo($name);
        $pictureBooks = PictureBook::with('readRecords', 'user')
            ->where('user_id', $data['user']->id);
        $data['pictureBooks'] = $pictureBooks->orderBy('updated_at', 'DESC')->paginate(10);

        $data['hasFollows'] = false;
        $data['hasTimeLine'] = true;

        $data['hasStored'] = true;
        $data['hasReadRecord'] = false;
        $data['hasLikes'] = false;

        return view('users.index', $data);
    }

    /**
     * ユーザーの読み聞かせ記録のタイムライン画面表示
     */
    public function readRecord(string $name)
    {
        $data = $this->collectUserInfo($name);
        $data['readRecords'] = ReadRecord::with('pictureBook', 'user', 'children')
            ->where('user_id', $data['user']->id)
            ->orderBy('updated_at', 'DESC')
            ->paginate(30);

        $data['hasFollows'] = false;
        $data['hasTimeLine'] = true;

        $data['hasStored'] = false;
        $data['hasReadRecord'] = true;
        $data['hasLikes'] = false;

        return view('users.index', $data);
    }

    /**
     * いいねしたレビュー一覧画面を表示
     */
    public function likes(string $name)
    {

        $data = $this->collectUserInfo($name);
        $data['pictureBooks'] = $data['user']->likes
            ->map(function ($pictureBook) {
                $pictureBook->liked_at  = $pictureBook->pivot->updated_at;
                return $pictureBook;
            })
            ->sortByDesc('liked_at')
            ->paginate(10);

        $data['hasFollows'] = false;
        $data['hasTimeLine'] = true;

        $data['hasStored'] = false;
        $data['hasReadRecord'] = false;
        $data['hasLikes'] = true;

        return view('users.index', $data);
    }

    /**
     * ユーザー基本データまとめ
     */
    private function collectUserInfo(string $user_name): array
    {
        $user = User::where('name', $user_name)->first();
        $family = Family::where('id', $user->family_id)->first();
        $familyUsers = $family->users->whereNotIn('id', $user->id)->sortBy('created_at');
        $children = $family->children->sortBy('birthday');

        $storedCount = $user->pictureBooks->count();
        $readRecordCount = $user->readRecords->count();
        $reviewCount = $user->pictureBooks->where('review', '!=', null)->count();

        $data = [
            'user' => $user,
            'family' => $family,
            'familyUsers' => $familyUsers,
            'children' => $children,
            'storedCount' => $storedCount,
            'readRecordCount' => $readRecordCount,
            'reviewCount' => $reviewCount,
        ];

        return $data;
    }

    /**
     * フォロー中画面表示
     */
    public function followings(string $name)
    {
        $data = $this->collectUserInfo($name);
        $data['followings'] = $data['user']->follows
            ->map(function ($followingFamily) {
                $followingFamily->storedCount = $followingFamily->pictureBooks->count();
                $followingFamily->readRecordCount = $followingFamily->readRecords->count();
                $followingFamily->reviewCount = $followingFamily->pictureBooks->where('review', '!=', null)->count();
                $followingFamily->followed_at = $followingFamily->pivot->updated_at;
                return $followingFamily;
            })
            ->sortByDesc('created_at')
            ->paginate(30);

        $data['hasFollows'] = true;
        $data['hasTimeLine'] = false;

        $data['hasFollowers'] = false;
        $data['hasFollowings'] = true;

        return view('users.index', $data);
    }

    /**
     * フォロワー画面表示
     */
    public function followers(string $name)
    {
        $data = $this->collectUserInfo($name);
        $data['followers'] = $data['family']->follows
            ->map(function ($followerUser) {
                $followerFamily =
                    Family::where('id', $followerUser->family_id)->first();
                $followerFamily->storedCount = $followerFamily->pictureBooks->count();
                $followerFamily->readRecordCount = $followerFamily->readRecords->count();
                $followerFamily->reviewCount = $followerFamily->pictureBooks->where('review', '!=', null)->count();
                $followerFamily->followed_at = $followerUser->pivot->updated_at;
                return $followerFamily;
            })
            ->sortByDesc('created_at')
            ->paginate(30);

        $data['hasFollows'] = true;
        $data['hasTimeLine'] = false;

        $data['hasFollowers'] = true;
        $data['hasFollowings'] = false;

        return view('users.index', $data);
    }

    /**
     * フォローする
     */
    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->follows()->detach($user);
        $request->user()->follows()->attach($user);

        return ['name' => $name];
    }

    /**
     * ユーザープロフィール設定画面表示
     */
    public function settingProfile()
    {
        $user = User::where('name', Auth::user()->name)->firstOrFail();
        $family = Family::with('users')->where('id', $user->family_id)->first();
        $familyUsers = $family->users->whereNotIn('id', $user->id)->sortBy('created_at');

        return view('users.setting_profile', [
            'user' => $user,
            'family' => $family,
            'familyUsers' => $familyUsers,
        ]);
    }

    /**
     * ユーザープロフィール編集画面表示
     */
    public function edit()
    {
        $user = Auth::user();

        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * ユーザープロフィール設定更新する
     */
    public function update(UserRequest $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->nickname = $request->nickname;
        $user->relation = $request->relation;
        if ($user->email !== $request->email) {
            $user->email_verified_at = null;
            $user->email = $request->email;
        }

        // 画像ファイルのアップロード
        if ($request->image != null) {
            $image = $request->file('image');
            if (app()->isLocal() || app()->runningUnitTests()) {
                // 開発環境
                $path = $image->storeAs('public/user_images', $user->id . '.jpg');
                $user->icon_path = Storage::url($path);
            } else {
                // 本番環境
                $path = Storage::disk('s3')->put('/', $image, 'public');
                $user->icon_path = Storage::disk('s3')->url($path);
            }
        }

        $user->fill($request->validated())->save();

        return redirect()->route('users.setting_profile');
    }
}
