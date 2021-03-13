<?php

namespace App\Http\Controllers;

use App\PictureBook;
use App\StoredPictureBook;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PictureBookRequest;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PictureBookController extends Controller
{
    /**
     * ログインユーザーの登録済み絵本を一覧表示する。
     */
    public function index()
    {
        $stored_picture_books = PictureBook::with('storedPictureBook')->get()->sortByDesc('created_at');

        return view('picture_books.index', ['stored_picture_books' => $stored_picture_books]);
    }

    /**
     * 絵本を登録するフォーム画面を表示する。
     */
    public function create(Request $request, PictureBook $picture_book)
    {
        $picture_book->fill($request->all());

        return view('picture_books.create', ['picture_book' => $picture_book]);
    }


    /**
     * 絵本を登録する。
     */
    public function store(PictureBookRequest $request, PictureBook $picture_book, StoredPictureBook $stored_picture_book)
    {

        try {
            DB::beginTransaction();

            $picture_book->fill($request->all());
            $picture_book->save();

            $picture_book_id = $picture_book->id;

            // $stored_picture_book->fill($request->all());
            $stored_picture_book->picture_book_id = $picture_book_id;
            $stored_picture_book->user_id = $request->user()->id;
            $stored_picture_book->fill($request->five_star_rating);
            $stored_picture_book->fill($request->read_status);
            $stored_picture_book->fill($request->summary);
            $stored_picture_book->save();

            DB::commit();
            return redirect()->route('picture_books.index');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('picture_books.index')->withInput()->with('flash_message', 'エラーが発生しました。');
        }
    }

    /**
     * Google Books APIから取得した検索結果を一覧表示する。
     */
    public function listSearchedPictureBooks(Request $request)
    {

        $data = [];

        $items = null;

        if (!empty($request->keyword)) {
            $title = urlencode($request->keyword);
            $url = 'https://www.googleapis.com/books/v1/volumes?q=' . $title . '&country=JP&tbm=bks';
            $client = new Client();
            $response = $client->request("GET", $url);
            $body = $response->getBody();
            $bodyArray = json_decode($body, true);
            $items = $bodyArray['items'];
        }

        //$item['id'] = $picture_book->google_books_id

        $data = [
            'items' => $items,
            'keyword' => $request->keyword,
        ];

        return view('picture_books.list_searched_picture_books', $data);
    }
}
