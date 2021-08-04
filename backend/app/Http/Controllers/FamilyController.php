<?php

namespace App\Http\Controllers;

use App\Family;
use App\User;
use App\PictureBook;
use App\ReadRecord;
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
     * 家族の登録絵本タイムライン画面表示
     */
    public function index(string $name)
    {
        $data = $this->collectFamilyInfo($name);
        $pictureBooks = PictureBook::with('user')
            ->where('family_id', $data['family']->id);
        $data['pictureBookNames'] = $this->booksSearchingTab($pictureBooks);
        $data['pictureBooks'] = $pictureBooks->orderBy('updated_at', 'DESC')->simplePaginate(10);

        $data['hasBookshelf'] = false;
        $data['hasTimeLine'] = true;

        $data['hasStored'] = true;
        $data['hasReadRecord'] = false;

        return view('families.index', $data);
    }

    /**
     * 家族の読み聞かせタイムライン画面表示
     */
    public function readRecord(string $name)
    {
        $data = $this->collectFamilyInfo($name);
        $pictureBooks = PictureBook::where('family_id', $data['family']->id);
        $data['pictureBookNames'] = $this->booksSearchingTab($pictureBooks);
        $data['readRecords'] = ReadRecord::with('pictureBook', 'user', 'children')
            ->where('family_id', $data['family']->id)
            ->orderBy('updated_at', 'DESC')
            ->simplePaginate(15);

        $data['hasBookshelf'] = false;
        $data['hasTimeLine'] = true;

        $data['hasStored'] = false;
        $data['hasReadRecord'] = true;

        return view('families.index', $data);
    }

    /**
     * 家族の本棚画面表示
     */
    public function bookshelf(string $name)
    {
        $data = $this->collectFamilyInfo($name);
        $pictureBooks = PictureBook::where('family_id', $data['family']->id);
        $data['pictureBookNames'] = $this->booksSearchingTab($pictureBooks);
        $data['pictureBooks'] = $pictureBooks->orderBy('updated_at', 'DESC')->simplePaginate(18);

        $data['hasBookshelf'] = true;
        $data['hasTimeLine'] = false;

        $data['hasStored'] = true;
        $data['hasRead'] = false;
        $data['hasCurious'] = false;

        return view('families.bookshelf', $data);
    }

    /**
     * 家族の本棚（読んだ絵本）画面表示
     */
    public function booksRead(string $name)
    {
        $data = $this->collectFamilyInfo($name);
        $pictureBooks = PictureBook::where('family_id', $data['family']->id);
        $data['pictureBookNames'] = $this->booksSearchingTab($pictureBooks);
        $data['pictureBooks'] = $pictureBooks->where('read_status', '!=', 0)
            ->orderBy('updated_at', 'DESC')->simplePaginate(18);

        $data['hasBookshelf'] = true;
        $data['hasTimeLine'] = false;

        $data['hasStored'] = false;
        $data['hasRead'] = true;
        $data['hasCurious'] = false;

        return view('families.bookshelf', $data);
    }

    /**
     * 家族の本棚（きになる絵本）画面表示
     */
    public function booksCurious(string $name)
    {
        $data = $this->collectFamilyInfo($name);
        $pictureBooks = PictureBook::where('family_id', $data['family']->id);
        $data['pictureBookNames'] = $this->booksSearchingTab($pictureBooks);
        $data['pictureBooks'] = $pictureBooks->where('read_status', '=', 0)
            ->orderBy('updated_at', 'DESC')->simplePaginate(18);

        $data['hasBookshelf'] = true;
        $data['hasTimeLine'] = false;

        $data['hasStored'] = false;
        $data['hasRead'] = false;
        $data['hasCurious'] = true;

        return view('families.bookshelf', $data);
    }

    /**
     * 登録絵本一件についての詳細画面表示（家族の登録情報、読み聞かせ記録一覧）
     */
    public function show(string $name, PictureBook $pictureBook)
    {
        $data = $this->collectFamilyInfo($name);
        $pictureBooks = PictureBook::with('readRecords', 'user')
            ->where('family_id', $data['family']->id);
        $data['pictureBookNames'] = $this->booksSearchingTab($pictureBooks);

        $data['pictureBook'] = $pictureBooks->where('id', $pictureBook->id)->first();
        $data['readRecords'] = ReadRecord::with('pictureBook', 'user', 'children')
            ->where('picture_book_id', $pictureBook->id)
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);

        $data['hasBookshelf'] = false;
        $data['hasTimeLine'] = false;

        $data['hasStored'] = false;
        $data['hasReadRecord'] = false;

        return view('families.show', $data);
    }

    /**
     * 各家族の基本データまとめ
     */
    private function collectFamilyInfo(string $name): array
    {
        $family = Family::where('name', $name)->first();
        $familyUsers = $family->users->sortBy('created_at');
        $children = $family->children->sortBy('birthday');

        $storedCount = $family->pictureBooks->count();
        $readRecordCount = $family->readRecords->count();
        $reviewCount = $family->pictureBooks->where('review', '!=', null)->count();
        $curiousCount = $family->pictureBooks->where('read_status', '=', 0)->count();
        $readCount = $family->pictureBooks->where('read_status', '=', 1)->count();

        $data = [
            'family' => $family,
            'familyUsers' => $familyUsers,
            'children' => $children,
            'storedCount' => $storedCount,
            'readRecordCount' => $readRecordCount,
            'reviewCount' => $reviewCount,
            'curiousCount' => $curiousCount,
            'readCount' => $readCount,
        ];

        return $data;
    }

    /**
     * 登録絵本検索バー
     */
    private function booksSearchingTab($pictureBooks)
    {
        return $pictureBooks->get()
            ->map(function ($pictureBook) {
                return [
                    'text' => $pictureBook->title,
                    'picture_book_id' => $pictureBook->id,
                ];
            });
    }

    /**
     * 家族設定画面表示
     */
    public function setting()
    {
        $family = Family::with('users', 'children')
            ->where('id', Auth::user()->family_id)->first();
        $user = User::where('id', Auth::id())->firstOrFail();
        $familyUsers = $family->users->whereNotIn('id', $user->id)->sortBy('created_at');
        $children = $family->children->sortBy('birthday');

        return view('families.setting', [
            'user' => $user,
            'family' => $family,
            'familyUsers' => $familyUsers,
            'children' => $children,
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
        $family->fill($request->all())->save();

        return redirect()->route('families.setting');
    }

    /**
     * フォローする
     */
    public function follow(Request $request, string $name)
    {
        $family = Family::where('name', $name)->first();

        if ($family->id === $request->user()->family_id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $family->follows()->detach($request->user()->id);
        $family->follows()->attach($request->user()->id);

        return ['name' => $family->name];
    }

    /**
     * フォロー解除する
     */
    public function unfollow(Request $request, string $name)
    {
        $family = Family::where('name', $name)->first();

        if ($family->id === $request->user()->family_id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $family->follows()->detach($request->user()->id);

        return ['name' => $family->name];
    }
}
