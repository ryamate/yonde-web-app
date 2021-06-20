<?php

namespace App\Http\Controllers;

use App\Child;
use App\PictureBook;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ChildRequest;

class ChildController extends Controller
{

    /**
     * お子さまタグを付けた絵本表示
     */
    public function show(string $id)
    {
        $child = Child::where('id', $id)->first();

        $pictureBooks = $child->readRecords
            ->map(function ($readRecord) {
                return PictureBook::where('family_id', Auth::user()->family_id)
                    ->where('id', $readRecord->picture_book_id)->first();
            })->unique('google_books_id');

        return view('children.show', [
            'child' => $child,
            'pictureBooks' => $pictureBooks,
        ]);
    }

    /**
     * お子さま追加フォーム画面表示
     */
    public function create()
    {
        return view('children.create');
    }

    /**
     * お子さまを追加する
     */
    public function store(ChildRequest $request, Child $child)
    {
        $child->fill($request->all());
        $child->family_id = Auth::user()->family_id;
        $child->save();

        return redirect()->route('families.show_setting', [
            'id' => Auth::user()->family_id,
        ]);
    }

    /**
     * お子さま情報編集画面表示
     */
    public function edit(string $child_id)
    {
        $child = Child::where('id', $child_id)->first();

        return view('children.edit', [
            'child' => $child,
        ]);
    }

    /**
     * お子さま情報を更新する
     */
    public function update(ChildRequest $request, string $child_id)
    {
        $child = Child::find($child_id);
        $child->fill($request->all());
        $child->save();

        return redirect()->route('families.show_setting', [
            'id' => Auth::user()->family_id,
        ]);
    }

    /**
     * お子さま情報を削除する
     */
    public function destroy(string $child_id)
    {
        $child = Child::find($child_id);
        $child->delete();

        return redirect()->route('families.show_setting', [
            'id' => Auth::user()->family_id,
        ]);
    }
}
