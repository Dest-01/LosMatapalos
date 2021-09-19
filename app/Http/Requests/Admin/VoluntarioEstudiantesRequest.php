<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VoluntarioEstudiantesRequest extends FormRequest
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
            'identificacion' => 'required|string|',
            'voluntariado_id' => 'required|integer|',
            'Universidad' => 'required|string|min:2|max:20',
            'carrera' => 'required|string|min:2|max:50',
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
            'Universidad' => 'required|string|min:2|max:20',
            'carrera' => 'required|string|min:2|max:50',
        ];
    }

    public function messages(){
        return [
            'identificacion.*' => 'La cedula se requiere, compruebe si existe',
            'voluntariado_id.*' => 'El nombre de voluntario se requiere, compruebe si existe',
            'Universidad.*' => 'Se requiere la universidad minimo 2 caracteres y maximo 20 caracteres',
            'carrera.*' => 'Se requiere la carrera de la universidad minimo 2 caracteres y maximo 50 caracteres',
        ];
    }
}
