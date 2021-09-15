<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DonativosRequest extends FormRequest
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
            'tipo' => 'required',
            'detalle' => 'required|min:10|max:20',
            'fecha' => 'required|date',
            'estado' => 'required',
            'photo' => 'required',
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
            'tipo' => 'required',
            'detalle' => 'required|max:20',
            'fecha' => 'required|date',
            'estado' => 'required',
            'photo' => 'required',
        ];
    }

    public function messages(){
        return [
            'tipo.*'=>'Seleccione el tipo de donativo',
            'detalle.*' => 'Requiere un breve detalle y máximo 20 caracterees',
            'fecha.*' => 'Seleccione una fecha para el donativo',
            'estado.*' => 'Seleccione el estado del donativo',
            'photo.*' => 'Cargue una foto del donativo',

        ];
    }
}
