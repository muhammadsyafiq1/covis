<?php

namespace App\Http\Requests;

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
        return [
            'nip' => 'required|unique:users,nip',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'nip.unique' => 'NIP is already exsist!',
            'username.unique' => 'Username is already exsist!',
            'email.unique' => 'Email is already exsist!',
        ];
    }
}
