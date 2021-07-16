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
        $pictureBooks = PictureBook::with('readRecords')
            ->withCount('readRecords')->get();

        // 新しく登録された絵本
        $pictureBooksNew = $pictureBooks->sortByDesc('created_at')->take(18);

        // 本棚登録数ランキング
        $storedCountRanking = $pictureBooks
            ->map(function ($pictureBook) use ($pictureBooks) {
                $pictureBook->stored_count = $pictureBooks
                    ->where('google_books_id', $pictureBook->google_books_id)->count();
                return $pictureBook;
            })
            ->unique('google_books_id')
            ->sortByDesc('stored_count')->take(8);

        // よみきかせ回数ランキング
        $readRecordRanking = $pictureBooks
            ->map(function ($pictureBook) use ($pictureBooks) {
                $sameTitleBooks = $pictureBooks
                    ->where('google_books_id', $pictureBook->google_books_id);
                $pictureBook->read_records_count = $sameTitleBooks
                    ->sum('read_records_count');
                return $pictureBook;
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


    /**
     * プライバシーポリシー画面表示
     */
    public function privacy()
    {
        return view('privacy');
    }

    /**
     * 利用規約画面表示
     */
    public function terms()
    {
        return view('terms');
    }
}
