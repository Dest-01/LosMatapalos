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
            //'identificacion' => 'regex:/[0-9]/|min:9|max:12',//cedula nacional
           // 'identificacion' => 'regex:/^[0-9]{10}/',//cedula residencial
           // 'identificacion' => 'regex:/^[0-9]{11-12}/',//pasaporte
            'identificacion' => 'required|',
            'nombre' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',
            'apellido1' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',
            'apellido2' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',
            'telefono' => 'required|regex:/^\d{8}$/',
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
            'telefono' => 'required|regex:/^\d{8}$/',
            'correo' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
        ];
    }

    public function messages(){
        return [
            'identificacion.*' => 'Se requiere un tipo de identificación',
            'nombre.regex' => 'Solo letras en el nombre',
            'apellido1.regex' => 'Solo letras en el primer apellido',
            'apellido2.regex' => 'Solo letras en el segundo apellido',
            'nombre.*' => 'Nombre requiere mínimo 3 caracteres y máximo 20',
            'apellido1.*' => 'El primer apellido requiere mínimo 3 caracteres y máximo 20',
            'apellido2.*' => 'El segundo apellido requiere mínimo 3 caracteres y máximo 20',
            'telefono.*' => 'Teléfono se requiere, mínimo 8 números',
            'correo.*' => 'Correo se requiere, ejemplo: ejemplo@gmail.com',
        ];
    }
}
