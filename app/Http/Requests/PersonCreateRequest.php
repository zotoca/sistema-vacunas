<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;

class PersonCreateRequest extends FormRequest
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
            "first_name" => "required|string",
            "last_name" => "required|string",
            "image" => "mimes:jpeg,jpg,png,gif,bmp,svg,webp",
            "dni" => "required|numeric|unique:persons,dni",
            "gender" => "required|in:masculino,femenino",
            "birthday" => "required|date|after:". Carbon::now()->subYear(110),
            "phone_number" => "required|string",
            "father_dni" => "nullable|exists:persons,dni",
            "mother_dni" => "nullable|exists:persons,dni",
            "house_id" => "required|exists:houses,id",
        ];
    }
    
    //public function failedValidation(Validator $validator){
    //    dd($validator->errors());

    //   throw new ValidatorException($errors);
    //}
}
