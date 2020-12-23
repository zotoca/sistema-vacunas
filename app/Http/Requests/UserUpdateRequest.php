<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user_id = request()->input("user_id");

        return [
            'first_name' => 'required_without_all:last_name,email,birthday,address,phone_number,password,repeatPassword,image|string',
            'last_name'  => 'required_without_all:first_name,email,birthday,address,phone_number,password,repeatPassword,image|string',
            'email' => [
                'required_without_all:first_name,last_name,birthday,address,phone_number,password,repeatPassword,image',
                'email',
                Rule::unique("users")->ignore($user_id)
            ],
            'birthday' => 'required_without_all:first_name,last_name,email,address,phone_number,password,repeatPassword,image|date',
            'address' => "required_without_all:first_name,last_name,email,birthday,phone_number,password,repeatPassword,image|string",
            "phone_number" => "required_without_all:first_name,last_name,email,birthday,address,password,repeatPassword,imagestring",
            "image" => "required_without_all:first_name,last_name,email,birthday,address,phone_number,password,repeatPassword|mimes:jpeg,jpg,png,gif,bmp,svg,webp",
            'password' => 'required_without_all:first_name,last_name,email,birthday,address,phone_number,image|nullable|string',
            'repeatPassword' => 'required_without_all:first_name,last_name,email,birthday,address,phone_number,image|same:password'
        ];
    }
}
