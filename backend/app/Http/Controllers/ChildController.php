<?php

namespace App\Http\Controllers;

use App\Child;
use App\Family;
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
        $data = $this->collectChildInfo($id);

        $data['readRecords'] = $data['child']->readRecords
            ->map(function ($readRecord) {
                $readRecord->read_at  = $readRecord->pivot->updated_at;
                return $readRecord;
            })
            ->sortByDesc('read_at')
            ->paginate(10);

        $data['hasTimeLine'] = true;

        $data['hasReadRecord'] = true;

        return view('children.show', $data);
    }

    /**
     * お子さま基本データまとめ
     */
    private function collectChildInfo(string $id): array
    {
        $child = Child::where('id', $id)->first();
        $family = Family::where('id', $child->family_id)->first();
        $familyUsers = $family->users->sortBy('created_at');
        $children = $family->children->whereNotIn('id', $child->id)->sortBy('birthday');

        $readRecordCount = $child->readRecords->count();

        $data = [
            'child' => $child,
            'family' => $family,
            'familyUsers' => $familyUsers,
            'children' => $children,
            'readRecordCount' => $readRecordCount,
        ];

        return $data;
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

        return redirect()->route('families.setting');
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

        return redirect()->route('families.setting');
    }

    /**
     * お子さま情報を削除する
     */
    public function destroy(string $child_id)
    {
        $child = Child::find($child_id);
        $child->delete();

        return redirect()->route('families.setting');
    }
}
