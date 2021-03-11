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
    public function index()
    {
        $stored_picture_books = PictureBook::all()->sortByDesc('created_at');

        return view('picture_books.index', ['stored_picture_books' => $stored_picture_books]);
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

            $stored_picture_book->fill($request->all());
            $stored_picture_book->picture_book_id = $picture_book_id;
            $stored_picture_book->user_id = $request->user()->id;
            $stored_picture_book->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Google Books APIから取得した検索結果を一覧表示する。
     */
    public function listPictureBookSearchResults(Request $request)
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

        $data = [
            'items' => $items,
            'keyword' => $request->keyword,
        ];

        return view('picture_books.list_picture_book_search_results', $data);
    }
}
