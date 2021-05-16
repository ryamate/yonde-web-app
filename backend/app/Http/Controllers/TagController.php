<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * タグ表示
     */
    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();

        return view('tags.show', ['tag' => $tag]);
    }
}
