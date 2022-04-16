<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GrupoRequest extends FormRequest
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
            'nombre' => 'required|regex:/^[G]{1}-\d{1,4}$/',
            'cantidad' => 'required|integer|min:1|max:100',
            'edades' => 'required|integer|min:5|max:109',
            'lugar' => 'required|string|min:3|max:150|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'tematica' => 'required|string|min:3|max:100|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'detalles' => 'string|max:250|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
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
            'nombre' => 'required|regex:/^[G]{1}-\d{1,4}$/',
            'cantidad' => 'required|integer|min:1|max:100',
            'edades' => 'required|integer|min:5|max:109',
            'lugar' => 'required|string|min:3|max:150|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'tematica' => 'required|string|min:3|max:100|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'detalles' => 'string|max:250|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'correo' => 'required|email|regex:/[\w._%+-]+@[\w.-]+\.[a-zA-Z]{2,4}/|min:4|max:100',
        ];
    }

    public function messages(){
        return [
            'nombre.regex' => "El formato tiene que ser G-1 a G-9999",
            'nombre.*' => "Se requiere un nombre del grupo",
            'cantidad.*' => "Se requiere un cantidad",
            'edades.*' => "Se requiere un rango de edad",
            'lugar.*' => "Se requiere un lugar de procedencia",
            'tematica.*' => "Se requiere una tematica de interes",
            'detalles.*' => "Notas a considerar",
            'correo.*' => "Se requiere un nombre correo, ejemplo@gmail.com",
            

        ];
    }
}
