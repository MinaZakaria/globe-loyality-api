<?php

namespace App\Http\Request\User;

use App\Http\Request\ApplicationRequest;

class RegisterRequest extends ApplicationRequest
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
            'name'=>'required|max:55',
            'email'=>'email|required|unique:users',
            'roleId'=>'required|int',
            'password'=>'required|confirmed'
        ];
    }
}
