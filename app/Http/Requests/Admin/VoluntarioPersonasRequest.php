<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VoluntarioPersonasRequest extends FormRequest
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
            'voluntariado_id' => 'required|integer|min:1|max:9999',
            'lugar' => 'required|string|min:3|max:50',
            'idVoluntario' => 'required|integer|min:1|max:9999',
            'cantidad' => 'required|integer|min:1|max:9999',
            
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
            'identificacion' => 'required|string|',
            'voluntariado_id' => 'required|integer|min:1|max:9999',
            'lugar' => 'required|string|min:3|max:50',
            'idVoluntario' => 'required|integer|min:1|max:9999',
            'cantidad' => 'required|integer|min:1|max:9999',
        ];
    }

    public function messages(){
        return [
            'identificacion.*' => 'La identificación se requiere, compruebe si existe',
            'voluntariado_id.*' => 'Se requiere un id, solo números',
            'lugar.*' => 'Se requiere lugar de procedencia',
            'idVoluntario.min' => 'Mínimo un número en el id del voluntario',
            'idVoluntario.*' => 'Se requiere un id de voluntario',
            'cantidad.*' => 'Se requiere la cantidad de actividades',
            
        ];
    }
}
