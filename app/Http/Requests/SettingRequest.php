<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['string', 'min:6'],
            'admin_level' => ['required', 'integer', 'digits:1', 'between:-1,10'],
            'board_api_key' => ['nullable'],
            'board_api_token' => ['nullable'],
            'board_verified_at' => ['date_format'],
        ];
    }
}
