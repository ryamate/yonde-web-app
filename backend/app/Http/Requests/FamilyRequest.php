<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class FamilyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $familyName = Auth::user()->family->name;
        if (Auth::id() !== config('const.GUEST_USER_ID')) {
            return [
                'name' => [
                    'required',
                    'string',
                    'alpha_num',
                    'min:3',
                    'max:16',
                    Rule::unique('families', 'name')->whereNot('name', $familyName),
                ],
                'nickname' => 'required|max:50',
                'introduction' => 'max:160',
            ];
        }
    }

    /**
     * バリデーションエラーメッセージに表示される項目名をカスタマイズする。
     */
    public function attributes()
    {
        return [
            'name' => 'ファミリーID',
            'nickname' => 'ファミリーネーム',
            'introduction' => '家族紹介',
        ];
    }
}
