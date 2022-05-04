<?php

namespace App\Http\Requests\Users;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /*
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /*
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|min:8|max:12|regex:/^(?=.[a-z])(?=.[A-Z])(?=.\d)[a-zA-Z\d]/',
            'confirm_password' => 'required|same:new_password',
        ];
    }

    public function messages(){
        return [
            'current_password.*' => 'La contraseña tiene que coincidir con la anterior',
            'new_password.min' => 'Se requiere contraseña minimo de 8 caracteres',
            'new_password.max' => 'Se requiere contraseña maximo de 12 caracteres',
            'new_password.required' => 'Se requiere contraseña',
            'new_password.regex' => 'Agrega mayusculas, minusculas y numeros',
            'confirm_password.same' => 'La contraseña no coincide',
            'confirm_password.*' => 'La contraseña se requiere',
        ];
    }
}