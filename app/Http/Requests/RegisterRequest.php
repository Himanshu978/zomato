<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:60'],
            'age' => ['required', 'string', 'max:3'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits_between:8,15'],
            'street_address' => ['required'],
            'district_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'c_password' => ['required'],
            'zip' => ['required']
        ];
    }

      /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'Username is required!',
            'username.string' => 'Username should be of string type!',
            'age.required' => 'Age is required!',
            'firstname.required' => 'Firstname is required!',
            'lastname.required' => 'Lastname is required!',
            'phone.required' => 'Please fill your phone number!',
            'street_address.required' => 'Please fill your street address!',
            'email.required' => 'Email is required!',
            'email.unique' => 'Email already exists!',
            'password.required' => 'Password is required!',
            'password.min' => 'Password must be atleast 6 characters long!',
            'zip.required' => 'Zip code is required!'
        ];
    }
}
