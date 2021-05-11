<?php

namespace App\Http\Controllers;

use App\PictureBook;
use App\StoredPictureBook;
use App\Tag;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoredPictureBookRequest;
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
        $this->authorizeResource(StoredPictureBook::class, 'stored_picture_book');
    }

    /**
     * ホーム画面を表示する。
     */
    public function home()
    {
        $storedPictureBooks = StoredPictureBook::with(['pictureBook', 'user'])->get()->sortByDesc('created_at');

        return view('picture_books.home', ['storedPictureBooks' => $storedPictureBooks]);
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
        $storedPictureBooks = StoredPictureBook::with(['pictureBook', 'user'])->orderBy('created_at', 'DESC')->paginate(5);

        return view('picture_books.index', ['storedPictureBooks' => $storedPictureBooks]);
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
    public function store(
        StoredPictureBookRequest $request,
        PictureBook $pictureBook,
        StoredPictureBook $storedPictureBook
    ) {

        try {
            DB::beginTransaction();

            $pictureBook->fill($request->all());
            $pictureBook->save();

            $pictureBookId = $pictureBook->id;

            $storedPictureBook->fill($request->all());
            $storedPictureBook->picture_book_id = $pictureBookId;
            $storedPictureBook->user_id = $request->user()->id;
            $storedPictureBook->save();

            DB::commit();

            $request->tags->each(function ($tagName) use ($storedPictureBook) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $storedPictureBook->tags()->attach($tag);
            });

            return redirect()->route('picture_books.index');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('picture_books.create')->withInput($request->all())
                ->with('flash_message', 'エラーが発生しました。');
        }
    }

    /**
     * 登録絵本情報の編集画面を表示する。
     */
    public function edit(StoredPictureBook $storedPictureBook)
    {
        $storedPictureBook = $storedPictureBook->with('pictureBook')
            ->find($storedPictureBook->id);

        $tagNames = $storedPictureBook->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('picture_books.edit', [
            'storedPictureBook' => $storedPictureBook,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }

    /**
     * 登録絵本情報を編集画面での編集内容に更新する。
     */
    public function update(StoredPictureBookRequest $request, StoredPictureBook $storedPictureBook)
    {
        $storedPictureBook->fill($request->all())->save();

        $storedPictureBook->tags()->detach();
        $request->tags->each(function ($tagName) use ($storedPictureBook) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $storedPictureBook->tags()->attach($tag);
        });

        return redirect()->route('picture_books.index');
    }

    /**
     * 登録絵本を削除する。
     */
    public function destroy(StoredPictureBook $storedPictureBook)
    {
        $storedPictureBook->delete();
        return redirect()->route('picture_books.index');
    }

    /**
     * 登録絵本詳細画面を表示する。
     */
    public function show(StoredPictureBook $storedPictureBook)
    {
        $storedPictureBook = $storedPictureBook->with('pictureBook')->find($storedPictureBook->id);
        return view('picture_books.show', ['storedPictureBook' => $storedPictureBook]);
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

    public function like(Request $request, StoredPictureBook $storedPictureBook)
    {
        $storedPictureBook->likes()->detach($request->user()->id);
        $storedPictureBook->likes()->attach($request->user()->id);

        return [
            'id' => $storedPictureBook->id,
            'countLikes' => $storedPictureBook->count_likes,
        ];
    }

    public function unlike(Request $request, StoredPictureBook $storedPictureBook)
    {
        $storedPictureBook->likes()->detach($request->user()->id);

        return [
            'id' => $storedPictureBook->id,
            'countLikes' => $storedPictureBook->count_likes,
        ];
    }
}
