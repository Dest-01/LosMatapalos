<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Actividades;
use App\Models\Voluntario;
use Illuminate\Http\Request;

class CalculosController extends BaseController
{

    protected $actividades = '';
    protected $voluntario = '';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Actividades $actividades, Voluntario $voluntario)
    {
        $this->middleware('auth:api');
        $this->actividades = $actividades;
        $this->voluntario = $voluntario;
    }

    public function actualizarparticipantes(Request $request, $id)
    {

        $rules = [
            'nombre' => 'required|string|max:20|min:3',
            'fecha' => 'required',
            'hora' => 'required',
            'descripcion' => 'required|string|max:255|min:3',
            'cantParticipantes' => 'required|integer|min:1|max:30',
            'tipo' => 'required',
        ];

        $messages = [
            'nombre.min' => 'Mínimo 3 caracteres',
            'nombre.max' => 'Máximo 20 caracteres',
            'nombre.*' => 'Nombre requiere',
            'fecha.*' => 'Fecha se requiere',
            'hora.*' => 'Seleccione un hora',
            'descripcion.min' => 'Mínimo 3 caracteres',
            'descripcion.max' => 'Máximo 20 caracteres',
            'descripcion.*' => 'Se requiere una breve descripción',
            'cantParticipantes.min' => 'Mínimo 1 participante',
            'cantParticipantes.max' => 'Máximo 30 participantes',
            'cantParticipantes.*' => 'Cantidad de participantes se requiere',
            'tipo.*' => 'Seleccione el tipo de actividad',
        ];

        $this->validate($request, $rules, $messages);

        $tag = $this->actividades->findOrFail($id);
        $currentFoto = $tag->imagen;
        if ($request->imagen != $currentFoto) {
            $name = time() . '.' . explode('/', explode(':', substr($request->imagen, 0, strpos
                ($request->imagen, ';')))[1])[1];

            \Image::make($request->imagen)->save(public_path('images/actividades/') . $name);
            $request->merge(['imagen' => $name]);

            $actividadFoto = public_path('images/actividades/') . $currentFoto;
            if (file_exists($actividadFoto)) {
                @unlink($actividadFoto);
            }
        }
        $tag->update($request->all());
        return $this->sendResponse($tag, 'Actividad Actualizada!');
    }



}
