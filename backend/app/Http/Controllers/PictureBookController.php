<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PictureBookController extends Controller
{
    public function showBookshelf()
    {
        // ダミーデータ
        $stored_picture_books = [
            (object) [
                'id' => 1,
                'title' => 'タイトル1',
                'authors' => '作者1',
                'published_date' => now(),
                'thumbnail_uri' => 'サムネイルURI1',
                'five_star_rating' => '1',
                'read_status' => 'よみきかせ状況1',
                'summary' => 'レビュー1です。レビュー1です。レビュー1です。',
                'created_at' => now(),
                'updated_at' => now(),
                'user' => (object) [
                    'id' => 1,
                    'name' => 'ユーザー名1',
                ],
            ],
            (object) [
                'id' => 2,
                'title' => 'タイトル2',
                'authors' => '作者2',
                'published_date' => now(),
                'thumbnail_uri' => 'サムネイルURI2',
                'five_star_rating' => '2',
                'read_status' => 'よみきかせ状況2',
                'summary' => 'レビュー2です。レビュー2です。レビュー2です。',
                'updated_at' => now(),
                'created_at' => now(),
                'user' => (object) [
                    'id' => 2,
                    'name' => 'ユーザー名2',
                ],
            ],
            (object) [
                'id' => 3,
                'title' => 'タイトル3',
                'authors' => '作者3',
                'published_date' => now(),
                'thumbnail_uri' => 'サムネイルURI3',
                'five_star_rating' => '3',
                'read_status' => 'よみきかせ状況3',
                'summary' => 'レビュー3です。レビュー3です。レビュー3です。',
                'created_at' => now(),
                'updated_at' => now(),
                'user' => (object) [
                    'id' => 3,
                    'name' => 'ユーザー名3',
                ],
            ],
        ];

        return view('picture_books.bookshelf', ['stored_picture_books' => $stored_picture_books]);
    }
}
