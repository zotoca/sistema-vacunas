<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;

class PersonVaccinationCreateRequest extends FormRequest
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
            "person_id" => "required|exists:persons,id",
            "vaccination_id" => "required|exists:vaccinations,id",
            "vaccination_date" => "required|date",
            "dose" => "nullable|numeric|between:1,9",
            "lot_number" => "nullable|string",
            "is_vaccinated" => "required|boolean"
        ];
    }

    
}
