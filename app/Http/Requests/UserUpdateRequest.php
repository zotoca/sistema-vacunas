<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;


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
            'first_name' => 'required_without_all:last_name,email,password,repeatPassword,image,delete_vaccine_permission|string',
            'last_name'  => 'required_without_all:first_name,email,password,repeatPassword,image,delete_vaccine_permission|string',
            'email' => [
                'required_without_all:first_name,last_name,password,repeatPassword,image,delete_vaccine_permission',
                'email',
                Rule::unique("users")->ignore($user)
            ],
            "image" => "required_without_all:first_name,last_name,email,password,repeatPassword,delete_vaccine_permission|mimes:jpeg,jpg,png,gif,bmp,svg,webp",
            'password' => 'required_without_all:first_name,last_name,email,image,delete_vaccine_permission|nullable|string',
            'repeatPassword' => 'required_without_all:first_name,last_name,email,image,delete_vaccine_permission|same:password',
            "delete_vaccine_permission" => "required_without_all:first_name,last_name,email,image,password|boolean"
        ];
    }

    public function failedValidation(Validator $validator){
        dd($validator->errors());

       throw new ValidatorException($errors);
    }
}
