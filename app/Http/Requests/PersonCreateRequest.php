<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


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
            "dni" => "required|numeric",
            "gender" => "required|in:masculino,femenino",
            "birthday" => "required|date",
            "phone_number" => "required|alpha_num",
            "father_dni" => "required|exists:persons,cedula",
            "mother_dni" => "required|exists:persons,cedula",
            "house_id" => "required|exists:houses,id",
            "person_vaccination" => "array",
            "person_vaccination.*.vaccination_id" => "exists:vaccinations,id",
            "person_vaccination.*.dose" => "string",
            "person_vaccination.*.lot_number" => "string",
            "person_vaccination.*.is_vaccinated" => "boolean",
            "person_vaccination.*.vaccination_date" => "date"
        ];
    }
}
