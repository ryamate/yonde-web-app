<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PictureBookRequest extends FormRequest
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
            'review' => 'max:1000',
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
            'review' => 'レビュー・感想',
        ];
    }
}
