<?php

namespace App\Http\Controllers;

use App\Tag;
use App\PictureBook;
use Auth;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * ユーザーが読み聞かせ記録時に、タグ付けした絵本表示
     */
    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();

        $pictureBooks = $tag->readRecords
            ->map(function ($readRecord) {
                return PictureBook::where('family_id', Auth::user()->family_id)
                    ->where('id', $readRecord->picture_book_id)->first();
            })->unique('google_books_id');

        return view('tags.show', [
            'tag' => $tag,
            'pictureBooks' => $pictureBooks
        ]);
    }
}
