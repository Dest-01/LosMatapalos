<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ActividadRequest extends FormRequest
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
            
            'nombre' => 'required|regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',
            'fecha' => 'required|date|',
            'hora' => 'required|time|',
            'descripcion' => 'required|string|max:250',
            'cantParticipantes' => 'required|integer|min:1|max:30',
            'imagen' => 'required|sometimes|base64image:png,jpeg,jpg',
            'tipo' => 'required',
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
            'fecha' => 'required|date|',
            'hora' => 'required|time|',
            'descripcion' => 'required|string|max:250',
            'cantParticipantes' => 'required|integer|',
            'imagen' => '|sometimes|base64image:png,jpeg,jpg',
            'tipo' => 'required',
        ];
    }

    public function messages(){
        return [
           
            'nombre.regex' => 'Solo letras en el nombre',
            'nombre.*' => 'Nombre requiere mínimo 3 caracteres y máximo 20',
            'fecha.*' => 'Seleccione una fecha',
            'hora.*' => 'Seleccione un hora',
            'descripcion.*' => 'Se requiere una breve descripción',
            'cantParticipantes.*' => 'Cantidad de participantes se requiere',
            'imagen.*' => 'Imagen se requiere',
            'tipo.*' => 'Tipo se requiere',
        ];
    }
}
