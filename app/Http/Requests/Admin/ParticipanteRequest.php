<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ParticipanteRequest extends FormRequest
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
            'identificacion' => 'required',
            'nombre' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:30|min:3',
            'apellido1' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:30|min:3',
            'apellido2' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:30|min:3',
            'nacionalidad' => 'required|string|min:3|max:40|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            
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
           
            'identificacion' => 'required',
            'nombre' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:30|min:3',
            'apellido1' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:30|min:3',
            'apellido2' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:30|min:3',
            'nacionalidad' => 'required|string|min:3|max:40|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
           
        ];
    }

    public function messages(){
        return [
            'identificacion.*' => 'La identificación se requiere',
            'nombre.regex' => 'Solo letras en el nombre',
            'apellido1.regex' => 'Solo letras en el primer apellido',
            'apellido2.regex' => 'Solo letras en el segundo apellido',
            'nombre.*' => 'Nombre requiere mínimo 3 caracteres y máximo 30',
            'apellido1.*' => 'El primer apellido requiere mínimo 3 caracteres y máximo 30',
            'apellido2.*' => 'El segundo apellido requiere mínimo 3 caracteres y máximo 30',
            'nacionalidad.*' => 'Se requiere la nacionalidad',
           
        ];
    }
}
