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
            'id' => 'required|integer|max:18|min:8|regex:/[0-9]{8,18}/',
            'nombre' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',
            'apellido1' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',
            'apellido2' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',
            'telefono' => 'required|integer|min:10000000|max:99999999|regex:/[0-9]{8,12}/',
            'correo' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
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
            'telefono' => 'required|integer|min:10000000|max:99999999|regex:/[0-9]{8,12}/',
            'correo' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
        ];
    }

    public function messages(){
        return [
            'id.*'=>'Cedula requiere mínimo 8 caracteres y máximo 18',
            'nombre.regex' => 'Solo letras en el nombre',
            'apellido1.regex' => 'Solo letras en el primer apellido',
            'apellido2.regex' => 'Solo letras en el segundo apellido',
            'nombre.*' => 'Nombre requiere mínimo 3 caracteres y máximo 20',
            'apellido1.*' => 'El primer apellido requiere mínimo 3 caracteres y máximo 20',
            'apellido2.*' => 'El segundo apellido requiere mínimo 3 caracteres y máximo 20',
            'telefono.*' => 'Telefono se requiere, mínimo 8 números',
            'correo.*' => 'Correo se requiere, ejemplo: ejemplo@gmail.com',
        ];
    }
}
