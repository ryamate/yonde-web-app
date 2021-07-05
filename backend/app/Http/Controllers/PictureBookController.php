<?php

namespace App\Http\Controllers;

use App\PictureBook;
use App\Family;
use Auth;
use App\Http\Requests\PictureBookRequest;
use Illuminate\Http\Request;
use Scriptotek\GoogleBooks\GoogleBooks;
use Illuminate\Pagination\LengthAwarePaginator;

class PictureBookController extends Controller
{
    /**
     * あるユーザーが登録した絵本を、家族以外のユーザーが更新・削除することを防ぐためのポリシー
     */
    public function __construct()
    {
        $this->authorizeResource(PictureBook::class, 'picture_book');
    }

    /**
     * 絵本登録フォーム画面表示
     */
    public function create(Request $request, PictureBook $pictureBook)
    {
        $pictureBook->fill($request->all());

        return view('picture_books.create', [
            'pictureBook' => $pictureBook,
        ]);
    }

    /**
     * 絵本を登録する
     */
    public function store(PictureBookRequest $request, PictureBook $pictureBook)
    {
        $pictureBook->fill($request->all());
        $pictureBook->user_id = $request->user()->id;
        $pictureBook->family_id = $request->user()->family_id;
        $pictureBook->save();

        return redirect()->route('families.index', ['id' => Auth::user()->family_id]);
    }

    /**
     * 登録絵本の編集画面表示
     */
    public function edit(PictureBook $pictureBook)
    {
        $pictureBook = $pictureBook->find($pictureBook->id);

        return view('picture_books.edit', [
            'pictureBook' => $pictureBook,
        ]);
    }

    /**
     * 登録絵本情報を編集画面での編集内容に更新する
     */
    public function update(PictureBookRequest $request, PictureBook $pictureBook)
    {
        $pictureBook->fill($request->all());
        $pictureBook->user_id = $request->user()->id;
        $pictureBook->save();

        return redirect()->route('families.index', ['id' => Auth::user()->family_id]);
    }

    /**
     * 登録絵本を削除する
     */
    public function destroy(PictureBook $pictureBook)
    {
        $pictureBook->delete();
        return redirect()->route('families.index', ['id' => Auth::user()->family_id]);
    }

    /**
     * 登録絵本の詳細画面表示（全家族の登録情報集計、レビュー掲載）
     */
    public function show(PictureBook $pictureBook)
    {
        $pictureBook = $pictureBook->find($pictureBook->id);

        // 全ユーザーの絵本についてのレビューを並べる。

        return view('picture_books.show', ['pictureBook' => $pictureBook]);
    }

    /**
     * 登録絵本から検索して、登録絵本情報を表示
     */
    public function searchBookshelf(Request $request)
    {
        if ($request->picture_book_id) {
            return redirect()->route('families.show', ['picture_book' => $request->picture_book_id]);
        } else {
            return redirect()->back();
        }
    }


    /**
     * 検索結果の一覧画面表示（Google Books APIから書籍情報取得）
     */
    public function search(Request $request)
    {
        $data = [];
        $paginatedSearchedBooks = null;

        if (!empty($request->keyword)) {

            $books = new GoogleBooks(['maxResults' => 30]);
            $searchedBooks = collect($books->volumes->search($request->keyword));

            //独自ページネータ
            $paginatedSearchedBooks = new LengthAwarePaginator(
                $searchedBooks->forPage($request->page, 10),
                $searchedBooks->count(),
                10,
                null,
                ['path' => $request->url()]
            );
        }

        // ログイン or 未ログイン
        if (Auth::user()) {
            $family = Family::where('id', Auth::user()->family_id)->first();
        } else {
            $family = '';
        }

        $data = [
            'searchedBooks' => $paginatedSearchedBooks,
            'family' => $family,
            'keyword' => $request->keyword,
        ];

        return view('picture_books.search', $data);
    }

    /**
     * いいねする
     */
    public function like(Request $request, PictureBook $pictureBook)
    {
        $pictureBook->likes()->detach($request->user()->id);
        $pictureBook->likes()->attach($request->user()->id);

        return [
            'id' => $pictureBook->id,
            'countLikes' => $pictureBook->count_likes,
        ];
    }

    /**
     * いいね解除する
     */
    public function unlike(Request $request, PictureBook $pictureBook)
    {
        $pictureBook->likes()->detach($request->user()->id);

        return [
            'id' => $pictureBook->id,
            'countLikes' => $pictureBook->count_likes,
        ];
    }
}
