<?php

namespace App\Http\Requests\Users;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ];
    }

    public function messages(){
        return [
            'current_password.*' => 'La contraseña tiene quue coincidir con la anterior',
            'new_password.min' => 'Se requiere contraseña minimo de 6 caracteres',
            'new_password.*' => 'Se requiere contraseña',
            'confirm_password.*' => 'Correo se requiere, ejemplo: ejemplo@gmail.com',
        ];
    }
}
