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
        $pictureBooks = PictureBook::with('user')->get()->sortByDesc('created_at');

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
