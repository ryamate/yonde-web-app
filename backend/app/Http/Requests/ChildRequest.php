<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildRequest extends FormRequest
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
            'name' => 'required|max:100|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
            'gender_code' => 'integer',
            'birthday' => 'date|before_or_equal:today',
        ];
    }

    /**
     * バリデーションエラーメッセージに表示される項目名をカスタマイズする。
     */
    public function attributes()
    {
        return [
            'name' => 'お名前',
            'gender_code' => '性別',
            'birthday' => 'お誕生日',
        ];
    }

    public function messages()
    {
        return [
            'birthday.before_or_equal' => ':attributeには、今日以前の日付をご利用ください。',
        ];
    }
}
