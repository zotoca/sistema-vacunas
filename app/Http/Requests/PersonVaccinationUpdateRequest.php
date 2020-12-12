<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonVaccinationUpdateRequest extends FormRequest
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
            "vaccination_id" => "required_without_all:vaccination_date,dose,lot_number|exists:vaccinations,id",
            "vaccination_date" => "required_without_all:vaccination_id,dose,lot_number|date",
            "dose" => "required_without_all:vaccination_id,vaccination_date,lot_number|string",
            "lot_number" => "required_without_all:vaccination_id,vaccination_date,dose|string"
        ];
    }
}
