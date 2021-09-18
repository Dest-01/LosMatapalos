<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VoluntarioRequest extends FormRequest
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
            'nombre' => 'required|string|max:20',
            'cantidad' => 'required|integer|',
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
            'nombre' => 'required|string|max:20',
            'cantidad' => 'required|integer|',
        ];
    }

    public function messages(){
        return [
            'nombre.*' => 'Nombre se requiere y maximo de 20 caracteres',
            'cantidad.*' => 'Se requiere una cantidad y solo números',
        ];
    }
}
