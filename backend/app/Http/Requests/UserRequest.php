<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class UserRequest extends FormRequest
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
        $user = Auth::user();
        return [
            'yonde_id' => [
                'required',
                'string',
                'alpha_num',
                'min:3',
                'max:16',
                Rule::unique('users', 'yonde_id')->whereNot('yonde_id', $user->yonde_id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'introduction' => ['nullable', 'string', 'max:1000'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->whereNot('email', $user->email),
            ],
        ];
    }
}
