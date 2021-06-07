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
        $pictureBooks = PictureBook::with('user')->get()->sortByDesc('created_at');

        // 本棚登録数ランキング
        // よみきかせ回数ランキング

        return view('home', ['pictureBooks' => $pictureBooks]);
    }

    /**
     * サービス概要紹介画面表示
     */
    public function about()
    {
        return view('about');
    }
}
