<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReadRecordRequest extends FormRequest
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
            'read_date' => 'date|before_or_equal:today',
            'memo' => 'max:1000',

        ];
    }

    /**
     * バリデーションエラーメッセージに表示される項目名をカスタマイズする。
     */
    public function attributes()
    {
        return [
            'read_date' => 'よんだ日',
            'memo' => 'メモ',
        ];
    }

    public function messages()
    {
        return [
            'read_date.before_or_equal' => ':attributeには、今日以前の日付をご利用ください。',
        ];
    }
}
