<?php

namespace App\Http\Controllers;

use App\PictureBook;
use App\Tag;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PictureBookRequest;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Scriptotek\GoogleBooks\GoogleBooks;
use Illuminate\Pagination\LengthAwarePaginator;

class PictureBookController extends Controller
{
    /**
     * あるユーザーが登録した絵本を、別のユーザーが更新・削除することを防ぐためのポリシー。
     */
    public function __construct()
    {
        $this->authorizeResource(PictureBook::class, 'picture_book');
    }

    /**
     * ホーム画面を表示する。
     */
    public function home()
    {
        $pictureBooks = PictureBook::with('user')->get()->sortByDesc('created_at');

        return view('picture_books.home', ['pictureBooks' => $pictureBooks]);
    }

    /**
     * サービス概要紹介画面を表示する。
     */
    public function about()
    {
        return view('picture_books.about');
    }

    /**
     * 登録絵本を一覧表示する。
     */
    public function index()
    {
        $pictureBooks = PictureBook::with('user')->orderBy('updated_at', 'DESC')->paginate(5);

        return view('picture_books.index', ['pictureBooks' => $pictureBooks]);
    }

    /**
     * 絵本登録フォーム画面を表示する。
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
     * 絵本を登録する。
     */
    public function store(PictureBookRequest $request, PictureBook $pictureBook)
    {
        $pictureBook->fill($request->all());
        $pictureBook->user_id = $request->user()->id;
        $pictureBook->save();

        $request->tags->each(function ($tagName) use ($pictureBook) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $pictureBook->tags()->attach($tag);
        });

        return redirect()->route('picture_books.index');
    }

    /**
     * 登録絵本情報の編集画面を表示する。
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
     * 登録絵本情報を編集画面での編集内容に更新する。
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
     * 登録絵本を削除する。
     */
    public function destroy(PictureBook $pictureBook)
    {
        $pictureBook->delete();
        return redirect()->route('picture_books.index');
    }

    /**
     * 登録絵本詳細画面を表示する。
     */
    public function show(PictureBook $pictureBook)
    {
        $pictureBook = $pictureBook->find($pictureBook->id);
        return view('picture_books.show', ['pictureBook' => $pictureBook]);
    }


    /**
     * 検索結果を一覧表示する（Google Books APIから書籍情報取得）。
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

        $data = [
            'searchedBooks' => $paginatedSearchedBooks,
            'keyword' => $request->keyword,
        ];

        return view('picture_books.search', $data);
    }

    public function like(Request $request, PictureBook $pictureBook)
    {
        $pictureBook->likes()->detach($request->user()->id);
        $pictureBook->likes()->attach($request->user()->id);

        return [
            'id' => $pictureBook->id,
            'countLikes' => $pictureBook->count_likes,
        ];
    }

    public function unlike(Request $request, PictureBook $pictureBook)
    {
        $pictureBook->likes()->detach($request->user()->id);

        return [
            'id' => $pictureBook->id,
            'countLikes' => $pictureBook->count_likes,
        ];
    }
}
