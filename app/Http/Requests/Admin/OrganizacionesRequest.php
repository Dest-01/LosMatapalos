<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrganizacionesRequest extends FormRequest
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
            'identificacion' => 'required|regex:/^[1-9]-\d{3}-\d{6}$/',
            'nombre' => 'required|string|min:3|max:20|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
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
            'nombre' => 'required|string|min:3|max:20|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'telefono' => 'required|regex:/^\d{8}$/',
            'correo' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
        ];
    }

    public function messages(){
        return [
            
            'identificacion.regex' => 'El formato de la cédula jurídica es incorrecto, ejemplo #-###-######',
            'identificacion.*' => 'El campo de la cédula jurídica es requerido',
            'nombre.regex' => 'Solo se permite letras',
            'nombre.*' => 'Nombre requiere mínimo 3 caracteres y máximo 20',
            'telefono.*' => 'Teléfono se requiere, 8 números',
            'correo.*' => 'Correo se requiere, ejemplo: ejemplo@gmail.com',
        ];
    }
}
