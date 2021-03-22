<?php

namespace App\Http\Controllers;

use App\PictureBook;
use App\StoredPictureBook;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoredPictureBookRequest;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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
        $stored_picture_books = StoredPictureBook::with(['pictureBook', 'user'])->get()->sortByDesc('created_at');

        return view('picture_books.home', ['stored_picture_books' => $stored_picture_books]);
    }

    /**
     * 登録絵本を一覧表示する。
     */
    public function index()
    {
        $stored_picture_books = StoredPictureBook::with(['pictureBook', 'user'])->get()->sortByDesc('created_at');

        return view('picture_books.index', ['stored_picture_books' => $stored_picture_books]);
    }

    /**
     * 絵本登録フォーム画面を表示する。
     */
    public function create(Request $request, PictureBook $picture_book)
    {
        $picture_book->fill($request->all());

        return view('picture_books.create', ['picture_book' => $picture_book]);
    }


    /**
     * 絵本を登録する。
     */
    public function store(StoredPictureBookRequest $request, PictureBook $picture_book, StoredPictureBook $stored_picture_book)
    {

        try {
            DB::beginTransaction();

            $picture_book->fill($request->all());
            $picture_book->save();

            $picture_book_id = $picture_book->id;

            $stored_picture_book->fill($request->all());
            $stored_picture_book->picture_book_id = $picture_book_id;
            $stored_picture_book->user_id = $request->user()->id;
            $stored_picture_book->save();

            DB::commit();

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
    public function edit(StoredPictureBook $stored_picture_book)
    {
        $stored_picture_book = $stored_picture_book->with('pictureBook')->find($stored_picture_book->id);
        return view('picture_books.edit', ['stored_picture_book' => $stored_picture_book]);
    }

    /**
     * 登録絵本情報を編集画面での編集内容に更新する。
     */
    public function update(StoredPictureBookRequest $request, StoredPictureBook $stored_picture_book)
    {
        $stored_picture_book->fill($request->all())->save();
        return redirect()->route('picture_books.index');
    }

    /**
     * 登録絵本を削除する。
     */
    public function destroy(StoredPictureBook $stored_picture_book)
    {
        $stored_picture_book->delete();
        return redirect()->route('picture_books.index');
    }

    /**
     * 登録絵本詳細画面を表示する。
     */
    public function show(StoredPictureBook $stored_picture_book)
    {
        $stored_picture_book = $stored_picture_book->with('pictureBook')->find($stored_picture_book->id);
        return view('picture_books.show', ['stored_picture_book' => $stored_picture_book]);
    }


    /**
     * 検索結果を一覧表示する（Google Books APIから書籍情報取得）。
     */
    public function search(Request $request)
    {

        $data = [];

        $searched_picture_books = null;

        if (!empty($request->keyword)) {
            $title = urlencode($request->keyword);
            $url = 'https://www.googleapis.com/books/v1/volumes?q=' . $title . '&country=JP&tbm=bks';
            $client = new Client();
            $response = $client->request("GET", $url);
            $body = $response->getBody();
            $bodyArray = json_decode($body, true);
            $items = $bodyArray['items'];

            error_reporting(E_ALL);
            foreach ($items as $item) {
                $authors_array = @$item["volumeInfo"]["authors"];
                if ($authors_array !== null) {
                    $authors = implode(",", $authors_array);
                } else {
                    $authors = null;
                }

                $searched_picture_books[] = [
                    'google_books_id' => @$item["id"],
                    'isbn_13' => @$item["volumeInfo"]["industryIdentifiers"][1]["identifier"],
                    'title' =>  @$item["volumeInfo"]["title"],
                    'authors' =>  $authors,
                    'published_date' => @$item["volumeInfo"]["publishedDate"],
                    'thumbnail_uri' => @$item["volumeInfo"]["imageLinks"]["thumbnail"],
                    'description' => @$item["volumeInfo"]["description"],
                ];
            }
        }

        $data = [
            'searched_picture_books' => $searched_picture_books,
            'keyword' => $request->keyword,
        ];

        return view('picture_books.search', $data);
    }
}
