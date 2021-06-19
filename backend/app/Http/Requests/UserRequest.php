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
        if (Auth::id() !== config('const.GUEST_USER_ID')) {
            return [
                'name' => [
                    'required',
                    'string',
                    'alpha_num',
                    'min:3',
                    'max:16',
                    Rule::unique('users', 'name')->whereNot('name', $user->name),
                ],
                'nickname' => ['required', 'string', 'max:255'],
                'relation' => ['nullable', 'string', 'max:100'],
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
}
