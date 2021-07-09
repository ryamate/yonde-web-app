<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return [
            'nickname' => 'required|string|max:100',
            'email' => 'required|string|email|max:255',
            'name' => 'required|string|max:100',
            'title' => 'nullable|string|max:100',
            'body' => 'required|string|max:1000',
        ];
    }

    /**
     * バリデーションエラーメッセージに表示される項目名をカスタマイズする。
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'nickname' => 'お名前',
            'title' => 'お問い合わせタイトル',
            'body' => 'お問い合わせ内容',
        ];
    }
}
