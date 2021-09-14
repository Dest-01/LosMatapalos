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
            'id' => 'required|string|max:18|min:8',
            'nombre' => 'required|string|max:20',
            'apellido1' => 'required|string|max:20',
            'apellido2' => 'required|string|max:20',
            'telefono' => 'required',
            'correo' => 'required',
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
           
            'nombre' => 'required|string|max:20|min:3',
            'apellido1' => 'required|string|max:20|min:3',
            'apellido2' => 'required|string|max:20|min:3',
            'telefono' => 'required',
            'correo' => 'required',
        ];
    }

    public function messages(){
        return [
            'id.*'=>'Cedula requiere mínimo 8 caracteres y máximo 18',
            'nombre.*' => 'Nombre requiere mínimo 3 caracteres y máximo 20',
            'apellido1.*' => 'El primer apellido requiere mínimo 3 caracteres y máximo 20',
            'apellido2.*' => 'El segundo apellido requiere mínimo 3 caracteres y máximo 20',
            'telefono.*' => 'Telefono se requiere',
            'correo.*' => 'Correo se requiere',
        ];
    }
}
