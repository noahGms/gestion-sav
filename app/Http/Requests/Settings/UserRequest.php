<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

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
        if (request()->method === 'POST') {
            return [
                'username' => 'required|string|unique:users,username',
                'firstname' => 'nullable|string',
                'lastname' => 'nullable|string',
                'password' => 'required|string|confirmed',
                'is_admin' => 'nullable|boolean',
            ];
        } else {
            return [
                'firstname' => 'nullable|string',
                'lastname' => 'nullable|string',
            ];
        }
    }
}
