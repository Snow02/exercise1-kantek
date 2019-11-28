<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAdmin extends FormRequest
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
            'name' => 'required',
            'username' =>'required|unique:admins,username',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is blank',
            'username.required' =>'Username is blank',
            'username.unique' =>'Username already exists',
            'email.required' =>'Email is blank',
            'email.unique' =>'Email already exists',
            'email.email' =>'Email incorrect ',
            'password.required' => 'Password is blank'
        ];
    }
}
