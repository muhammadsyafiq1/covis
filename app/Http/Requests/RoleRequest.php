<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'code' => 'required|unique:user_roles,code|max:4',
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'Code already exist! Try another',
            'code.max' => 'Code Max. Length is 4',
        ];
    }
}
