<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Family;
use App\PictureBook;
use App\ReadRecord;
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
        $readRecords = $tag->readRecords
            ->sortByDesc('updated_at')
            ->paginate(10);

        $data = [
            'tag' => $tag,
            'readRecords' => $readRecords,
            'hasTimeLine' => true,
            'hasTag' => true,
        ];

        return view('tags.show', $data);
    }
}
