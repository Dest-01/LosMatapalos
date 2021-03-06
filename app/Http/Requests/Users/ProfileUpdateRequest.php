<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'name' => '|string|max:191',
            'email' => '|string|email|max:191|unique:users,email,' . $this->user()->id
        ];
    }

    public function messages(){
        return [
            'name.*' => 'Se requiere un nombre de usuario',
            'email.*' => 'Correo se requiere, ejemplo: ejemplo@gmail.com',
        ];
    }
}
