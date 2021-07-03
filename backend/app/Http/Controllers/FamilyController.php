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
     * 家族のタイムライン画面表示
     */
    public function index(string $family_id)
    {
        $data = $this->booksChangingTab($family_id);
        $pictureBooks = PictureBook::with('readRecords', 'user')
            ->where('family_id', $family_id)
            ->orderBy('updated_at', 'DESC');
        $data['pictureBookNames'] = $this->booksSearchingTab($pictureBooks);
        $data['pictureBooks'] = $pictureBooks->paginate(5);

        return view('families.index', $data);
    }

    /**
     * 家族の読み聞かせタイムライン画面表示
     */
    public function readRecord(string $family_id)
    {
        $data = $this->booksChangingTab($family_id);
        $pictureBooks = PictureBook::where('family_id', $family_id)
            ->orderBy('updated_at', 'DESC');
        $data['pictureBookNames'] = $this->booksSearchingTab($pictureBooks);
        $data['readRecords'] = ReadRecord::with('pictureBook', 'user', 'children')
            ->where('family_id', $family_id)
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);

        return view('families.read_record', $data);
    }

    /**
     * 家族の本棚画面表示
     */
    public function bookshelf(string $family_id)
    {
        $data = $this->booksChangingTab($family_id);
        $pictureBooks = PictureBook::where('family_id', $family_id)
            ->orderBy('updated_at', 'DESC');
        $data['pictureBookNames'] = $this->booksSearchingTab($pictureBooks);
        $data['pictureBooks'] = $pictureBooks->paginate(30);

        return view('families.bookshelf', $data);
    }

    /**
     * 家族の本棚（読んだ絵本）画面表示
     */
    public function booksRead(string $family_id)
    {
        $data = $this->booksChangingTab($family_id);
        $pictureBooks = PictureBook::where('family_id', $family_id)
            ->orderBy('updated_at', 'DESC');
        $data['pictureBookNames'] = $this->booksSearchingTab($pictureBooks);
        $data['pictureBooks'] = $pictureBooks->where('read_status', '!=', 0)->paginate(30);

        return view('families.books_read', $data);
    }

    /**
     * 家族の本棚（きになる絵本）画面表示
     */
    public function booksCurious(string $family_id)
    {
        $data = $this->booksChangingTab($family_id);
        $pictureBooks = PictureBook::where('family_id', $family_id)->orderBy('updated_at', 'DESC');
        $data['pictureBookNames'] = $this->booksSearchingTab($pictureBooks);
        $data['pictureBooks'] = $pictureBooks->where('read_status', '=', 0)->paginate(30);

        return view('families.books_curious', $data);
    }

    /**
     * 各家族の基本データまとめ（family_card.blade.php で主に使用）
     */
    private function booksChangingTab(string $family_id): array
    {
        $family = Family::where('id', $family_id)->first();
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
    public function showSetting()
    {
        $family = Family::with('users', 'children')->where('id', Auth::user()->family_id)->first();
        $user = User::where('id', Auth::id())->firstOrFail();
        $familyUsers = $family->users->whereNotIn('id', $user->id)->sortBy('created_at');
        $children = $family->children->sortBy('birthday');

        return view('families.show_setting', [
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

        return redirect()->route('families.show_setting');
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


}
