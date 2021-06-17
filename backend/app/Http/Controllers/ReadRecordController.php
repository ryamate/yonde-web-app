<?php

namespace App\Http\Controllers;

use App\PictureBook;
use App\Child;
use App\ReadRecord;
use App\Tag;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ReadRecordRequest;

class ReadRecordController extends Controller
{
    /**
     * 絵本登録フォーム画面表示
     */
    public function create(Request $request)
    {
        $pictureBook = PictureBook::where('id', $request->picture_book_id)->first();
        $children = Child::where('family_id', Auth::user()->family_id)->get();

        return view('read_records.create', [
            'pictureBook' => $pictureBook,
            'children' => $children,
        ]);
    }

    /**
     * 読み聞かせを記録する
     */
    public function store(ReadRecordRequest $request, ReadRecord $readRecord)
    {
        $readRecord->fill($request->all());
        $readRecord->user_id = Auth::id();
        $readRecord->picture_book_id = $request->picture_book_id;
        $readRecord->save();

        $request->tags->each(function ($tagName) use ($readRecord) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $readRecord->tags()->attach($tag);
        });

        return redirect()->route('families.index', ['id' => Auth::user()->family_id]);
    }

    /**
     * 読み聞かせ記録の編集画面表示
     */
    public function edit(Request $request, ReadRecord $readRecord)
    {
        $pictureBook = PictureBook::where('id', $request->picture_book_id)->first();
        $children = Child::where('family_id', Auth::user()->family_id)->get();
        $readRecord = $readRecord->find($readRecord->id);

        $tagNames = $readRecord->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('read_records.edit', [
            'pictureBook' => $pictureBook,
            'children' => $children,
            'readRecord' => $readRecord,
            'tagNames' => $tagNames,
        ]);
    }

    /**
     * 読み聞かせ記録を編集画面での編集内容に更新する
     */
    public function update(ReadRecordRequest $request, ReadRecord $readRecord)
    {
        $readRecord->fill($request->all());
        $readRecord->user_id = Auth::id();
        $readRecord->picture_book_id = $request->picture_book_id;
        $readRecord->save();

        $readRecord->tags()->detach();
        $request->tags->each(function ($tagName) use ($readRecord) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $readRecord->tags()->attach($tag);
        });

        return redirect()->route('families.index', ['id' => Auth::user()->family_id]);
    }

    /**
     * 登録絵本を削除する
     */
    public function destroy(ReadRecord $readRecord)
    {
        $readRecord->delete();
        return redirect()->route('families.index', ['id' => Auth::user()->family_id]);
    }
}
