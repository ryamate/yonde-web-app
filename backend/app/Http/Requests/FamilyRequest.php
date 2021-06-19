<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
        if (Auth::id() !== config('const.GUEST_USER_ID')) {
            return [
                'name' => 'required|max:100',
                'introduction' => 'max:1000',
            ];
        }
    }

    /**
     * バリデーションエラーメッセージに表示される項目名をカスタマイズする。
     */
    public function attributes()
    {
        return [
            'name' => 'ファミリーネーム',
            'introduction' => '紹介文',
        ];
    }
}
