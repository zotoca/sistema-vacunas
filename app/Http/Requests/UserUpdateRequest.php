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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = request()->route("user");
        

        return [
            'first_name' => 'required_without_all:last_name,email,password,repeatPassword,image|string',
            'last_name'  => 'required_without_all:first_name,email,password,repeatPassword,image|string',
            'email' => [
                'required_without_all:first_name,last_name,password,repeatPassword,image',
                'email',
                Rule::unique("users")->ignore($user)
            ],
            "image" => "required_without_all:first_name,last_name,email,password,repeatPassword|mimes:jpeg,jpg,png,gif,bmp,svg,webp",
            'password' => 'required_without_all:first_name,last_name,email,image|nullable|string',
            'repeatPassword' => 'required_without_all:first_name,last_name,email,image|same:password'
        ];
    }
}
