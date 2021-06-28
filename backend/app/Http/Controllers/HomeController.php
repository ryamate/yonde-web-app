<?php

namespace App\Http\Controllers;

use App\PictureBook;

class HomeController extends Controller
{
    /**
     * ホーム画面表示
     */
    public function home()
    {
        // 新しく登録された絵本
        $pictureBooks = PictureBook::with('readRecords')
            ->withCount('readRecords')
            ->get()->sortByDesc('created_at');

        $pictureBooksNew = $pictureBooks->take(18);

        // 本棚登録数ランキング
        $storedCountRanking = $pictureBooks
            ->map(function ($item, $key) use ($pictureBooks) {
                $item->stored_count = $pictureBooks
                    ->where('google_books_id', $item->google_books_id)->count();
                return $item;
            })
            ->unique('google_books_id')
            ->sortByDesc('stored_count')->take(8);

        // よみきかせ回数ランキング
        $readRecordRanking = $pictureBooks
            ->map(function ($item, $key) use ($pictureBooks) {
                $sameBooks = $pictureBooks
                    ->where('google_books_id', $item->google_books_id);
                $item->read_records_count = $sameBooks
                    ->sum('read_records_count');
                return $item;
            })
            ->unique('google_books_id')
            ->sortByDesc('read_records_count')->take(8);

        return view('home', [
            'pictureBooksNew' => $pictureBooksNew,
            'storedCountRanking' => $storedCountRanking,
            'readRecordRanking' => $readRecordRanking,
        ]);
    }

    /**
     * サービス概要紹介画面表示
     */
    public function about()
    {
        return view('about');
    }
}
