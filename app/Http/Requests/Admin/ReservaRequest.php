<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReservaRequest extends FormRequest
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
            'cantidad' => 'required|numeric|min:1|max:30',
            'fecha' => 'required|date|',
            'horaInicio' => 'required',
            'horaFin' => 'required',
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
           
            'cantidad' => 'required|numeric|min:1|max:30',
            'fecha' => 'required',
            'horaInicio' => 'required',
            'horaFin' => 'required',
        ];
    }

    public function messages(){
        return [
            'cantidad.*'=>'Minimo de 1 y maxima 30',
            'fecha.*' => 'Seleccione la fecha',
            'horaInicio.*' => 'Selecciona la hora inicial',
            'horaFin.*' => 'Selecciona la hora fin',
        ];
    }
}