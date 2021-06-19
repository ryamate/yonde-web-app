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
            'memo' => 'max:140',
            'children' => 'json|min:3',
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
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
            'children' => 'お子さま',
            'tags' => 'タグ',
        ];
    }

    public function messages()
    {
        return [
            'read_date.before_or_equal' => ':attributeには、今日以前の日付をご利用ください。',
            'children.min' => 'お子さまは必ず指定してください。',
        ];
    }

    /**
     * children,tagsの整形を行う。
     */
    public function passedValidation()
    {
        $this->children = collect(json_decode($this->children))
            ->map(function ($requestChild) {
                $requestChild->text;
                $requestChild->child_id;
                return $requestChild;
            });

        $this->tags = collect(json_decode($this->tags))
            ->slice(0, 5)
            ->map(function ($requestTag) {
                return $requestTag->text;
            });
    }
}
