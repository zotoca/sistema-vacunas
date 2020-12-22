<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

use Carbon\Carbon;

class PersonUpdateRequest extends FormRequest
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
        $person = $this->route("person");
        
        $person_id = request()->input("person_id");

        return [
            "first_name" => "required_without_all:last_image,image,dni,gender,birthday,phone_number,father_dni,mother_dni,house_id|string",
            "last_name" => "required_without_all:first_name,image,dni,gender,birthday,phone_number,father_dni,mother_dni,house_id|string",
            "image" => "nullable|mimes:jpeg,jpg,png,gif,bmp,svg,webp",
            "dni" => [
                "required_without_all:first_name,last_name,image,gender,birthday,phone_number,father_dni,mother_dni,house_id",
                "numeric",
                Rule::unique("persons")->ignore($person_id, "id")
            ],
            "gender" => "required_without_all:first_name,last_name,image,dni,birthday,phone_number,father_dni,mother_dni,house_id|in:masculino,femenino",
            "birthday" => "required_without_all:first_name,last_name,image,dni,gender,phone_number,father_dni,mother_dni,house_id|date|after:". Carbon::now()->subYear(110),
            "phone_number" => "required_without_all:first_name,last_name,image,dni,gender,birthday,father_dni,mother_dni,house_id|string",
            "father_dni" => "nullable|exists:persons,dni",
            "mother_dni" => "nullable|exists:persons,dni",
            "house_id" => "required_without_all:first_name,last_name,image,dni,gender,birthday,phone_number,father_dni,mother_dni|exists:houses,id",
        ];
    }
    public function failedValidation(Validator $validator){
        dd($validator->errors());

    //   throw new ValidatorException($errors);
    }
}
