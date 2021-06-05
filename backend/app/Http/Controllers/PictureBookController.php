<?php

namespace App\Http\Controllers;

use App\PictureBook;
use App\Tag;
use Auth;
use App\Http\Requests\PictureBookRequest;
use Illuminate\Http\Request;
use Scriptotek\GoogleBooks\GoogleBooks;
use Illuminate\Pagination\LengthAwarePaginator;

class PictureBookController extends Controller
{
    /**
     * あるユーザーが登録した絵本を、別のユーザーが更新・削除することを防ぐためのポリシー
     */
    public function __construct()
    {
        $this->authorizeResource(PictureBook::class, 'picture_book');
    }

    /**
     * 登録絵本の一覧画面表示
     */
    public function index()
    {
        $pictureBooks = PictureBook::with('user')->orderBy('updated_at', 'DESC')->paginate(5);

        return view('picture_books.index', ['pictureBooks' => $pictureBooks]);
    }

    /**
     * 絵本登録フォーム画面表示
     */
    public function create(Request $request, PictureBook $pictureBook)
    {
        $pictureBook->fill($request->all());

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('picture_books.create', [
            'pictureBook' => $pictureBook,
            'allTagNames' => $allTagNames,
        ]);
    }

    /**
     * 絵本を登録する
     */
    public function store(PictureBookRequest $request, PictureBook $pictureBook)
    {
        $pictureBook->fill($request->all());
        $pictureBook->stored_user_id = $request->user()->id;
        $pictureBook->family_id = $request->user()->family_id;
        $pictureBook->save();

        // $request->tags->each(function ($tagName) use ($pictureBook) {
        //     $tag = Tag::firstOrCreate(['name' => $tagName]);
        //     $pictureBook->tags()->attach($tag);
        // });

        return redirect()->route('picture_books.index');
    }

    /**
     * 登録絵本の編集画面表示
     */
    public function edit(PictureBook $pictureBook)
    {
        $pictureBook = $pictureBook->find($pictureBook->id);

        $tagNames = $pictureBook->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('picture_books.edit', [
            'pictureBook' => $pictureBook,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }

    /**
     * 登録絵本情報を編集画面での編集内容に更新する
     */
    public function update(PictureBookRequest $request, PictureBook $pictureBook)
    {
        $pictureBook->fill($request->all())->save();

        $pictureBook->tags()->detach();
        $request->tags->each(function ($tagName) use ($pictureBook) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $pictureBook->tags()->attach($tag);
        });

        return redirect()->route('picture_books.index');
    }

    /**
     * 登録絵本を削除する
     */
    public function destroy(PictureBook $pictureBook)
    {
        $pictureBook->delete();
        return redirect()->route('picture_books.index');
    }

    /**
     * 登録絵本の詳細画面表示
     */
    public function show(PictureBook $pictureBook)
    {
        $pictureBook = $pictureBook->find($pictureBook->id);
        return view('picture_books.show', ['pictureBook' => $pictureBook]);
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

        $user = Auth::user();

        $data = [
            'searchedBooks' => $paginatedSearchedBooks,
            'user' => $user,
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
