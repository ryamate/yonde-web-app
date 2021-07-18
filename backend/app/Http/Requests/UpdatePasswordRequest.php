<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
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
                'current_password' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (!(Hash::check($value, Auth::user()->password))) {
                            return $fail('現在のパスワードを正しく入力してください');
                        }
                    },
                ],
                'password' => 'required|string|min:8|confirmed|different:current_password',
            ];
        }
    }
}
