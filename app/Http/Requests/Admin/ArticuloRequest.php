<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloRequest extends FormRequest
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
            'Name' => 'required',
            'Type' => 'required|min:10|max:20',
            'Image' => 'required',
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
            'Name' => 'required',
            'Type' => 'required|min:10|max:20',
            'Image' => 'required',
        ];
    }

    public function messages(){
        return [
            'Name.*'=>'Digite el nombre del articulo',
            'Type.*' => 'Indique tipo de articulo a publicar',
            'Image.*' => 'Cargue una foto del Articulo',

        ];
    }
}
