<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PersonasRequest extends FormRequest
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
            'nombre' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',
            'apellido1' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',
            'apellido2' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',
            'telefono' => 'required|regex:/^[2-9]\d{3}\d{4}$/',
            'correo' => 'required|email|regex:/[\w._%+-]+@[\w.-]+\.[a-zA-Z]{2,4}/|min:4|max:100',                                                    
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
 
            'nombre' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',
            'apellido1' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',
            'apellido2' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',
            'telefono' => 'required|regex:/^[2-9]\d{3}\d{4}$/',
            'correo' => 'required|email|regex:/[\w._%+-]+@[\w.-]+\.[a-zA-Z]{2,4}/|min:4|max:100',                                              
        ];
    }

    public function messages(){
        return [
            'nombre.regex' => 'Solo letras en el nombre',
            'apellido1.regex' => 'Solo letras en el primer apellido',
            'apellido2.regex' => 'Solo letras en el segundo apellido',
            'nombre.*' => 'Nombre requiere mínimo 3 caracteres y máximo 20',
            'apellido1.*' => 'El primer apellido requiere mínimo 3 caracteres y máximo 20',
            'apellido2.*' => 'El segundo apellido requiere mínimo 3 caracteres y máximo 20',
            'telefono.*' => 'Teléfono se requiere, 8 dígitos',
            'correo.*' => 'Correo se requiere, ejemplo: ejemplo@gmail.com',
        ];
    }
}
