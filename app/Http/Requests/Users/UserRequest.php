<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }

    /**
     * Define validation rules to store method for resource creation
     *
     * @return array
     */
    public function createRules(): array
    {
        return [
            'type' => 'required|in:admin,user',
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]/',
        ];
    }

    /**
     * Define validation rules to update method for resource update
     *
     * @return array
     */
    public function updateRules(): array
    {
        return [
            'type' => 'sometimes|in:admin,user',
            'name' => 'sometimes|string|max:191',
            'email' => 'sometimes|string|email|max:191|unique:users,email,' . $this->get('id'),
            'password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]/'
        ];
    }
    public function messages(){
        return [
            'name.mun' => 'Minimo de 3 caracteres',
            'name.max' => 'Máximo de 100 caracteres',
            'name.*' => 'Se requiere un nombre',
            'email.*' => 'Se require un correo',
            'password.required' => 'Se require una contraseña',
            'password.min' => 'Minimo 8 caracteres',
            'password.max' => 'Máximo 20 caracteres',
            'password.regex' => 'Agrega mayúsculas, minúsculas y números',
            'type.*' => 'Seleccione un tipo de rol',
        ];
    }
}