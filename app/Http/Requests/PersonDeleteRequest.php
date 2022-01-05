<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Hash;

class PersonDeleteRequest extends FormRequest
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
            "password" => ["required",function($attribute, $value, $fails){
                $old_password = auth()->user()->password;
                
                $password = $this->all()["password"];
           
                
                if(!Hash::check($password, $old_password)){
                    $fails("Contraseña incorrecta");
                }
                
            }]
        ];
    }
}
