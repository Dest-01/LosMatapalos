<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Admin\PersonasRequest;
use App\Http\Requests\admin\VoluntarioPersonasRequest;
use App\Models\Personas;
use App\Models\Voluntario;
use App\Models\VoluntarioPersona;
use Illuminate\Http\Request;

class VoluntarioPersonaController extends BaseController
{

    protected $personas = '';
    protected $voluntarios = '';
    protected $voluntarioPersona = '';

    public function __construct(VoluntarioPersona $voluntarioPersona, Personas $personas, Voluntario $voluntarios)
    {
        $this->middleware('auth:api');
        $this->voluntarioPersona = $voluntarioPersona;
        $this->personas = $personas;
        $this->voluntarios = $voluntarios;
    }

    public function obtenerCedula(Request $request)
    {
        $filtro = $request->buscadorC;
        $persona = Personas::where('id', $filtro)->get('id');
        return $this->sendResponse($persona, 'Cedula si existe');

    }

    public function obtenerCantidad(Request $request)
    {
        $filtro = $request->VolCantidad;
        $cantidad = Voluntario::where('id', $filtro)->get();
        return $this->sendResponse($cantidad, 'Se encontro el id si existe');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voluntarioPer = $this->voluntarioPersona->latest()->paginate(10);

        return $this->sendResponse($voluntarioPer, 'Lista de personas de voluntario');
    }

    public function cargarVoluntarios()
    {
        $voluntario = $this->voluntarios->latest()->paginate(10);

        return $this->sendResponse($voluntario, 'Lista de voluntariado');
    }

    public function guardarPersona(PersonasRequest $request)
    {
        try {
            $filtro = $request->id;
            $existencia = Personas::where('id', '=', $filtro)->first();
            if ($existencia === null) {
                $tag = $this->personas->create([
                    'id' => $request->get('id'),
                    'nombre' => $request->get('nombre'),
                    'apellido1' => $request->get('apellido1'),
                    'apellido2' => $request->get('apellido2'),
                    'telefono' => $request->get('telefono'),
                    'correo' => $request->get('correo'),
                ]);

                return $this->sendResponse($tag, 'Registro exitoso!');
            } else {
                return response()->json(['success' => false, 'message' => 'Cedula ya existe!']);
            }

        } catch (\Exception$e) {
            return $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'identificacion' => 'required|string|max:18|min:8|regex:/[0-9]{8,18}/',
                'cantidad'=> 'required|integer|min:1|max:30|regex:/[0-9]{1,30}/',
                'lugar'=> 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\s]+$/|string|max:70|min:3',
                'idVoluntario' => 'required|integer|min:1|',
            ];
            $messages = [
                'cantidad.min' => 'Mínimo 1 actividad',
                'cantidad.max' => 'Maximo 30 actividades',
                'cantidad.*' => 'Se requiere una cantidad de actividades',
                'lugar.min' => 'Mínimo 3 caracteres',
                'lugar.max' => 'Maximo 70 caracteres',
                'lugar.*' => 'Se requiere un lugar de procedencia',
                'idVoluntario' => 'Mínimo 1 Id de voluntario',
                'idVoluntario.*' => 'Se requiere un Id de voluntario',
            ];
            $this->validate($request, $rules,$messages);
            
            $filtro = $request->idVoluntario;
            $existencia = Voluntario::where('id', '=', $filtro)->first();
            if ($existencia === null) {
                $tag = $this->voluntarios->create([
                    'id' => $request->get('idVoluntario'),
                    'cantidad' => $request->get('cantidad'),
                ]);
                $tag = $this->voluntarioPersona->create([
                    'identificacion' => $request->get('identificacion'),
                    'voluntariado_id' => $request->get('voluntariado_id'),
                    'lugar' => $request->get('lugar'),
                ]);
                return $this->sendResponse($tag, 'Registro exitoso!');
            } else {
                return response()->json(['success' => false, 'message' => 'El id del voluntario ya existe!']);
            }

        } catch (\Exception$e) {
            return $e->getMessage();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoluntarioPersona  $voluntarioPersona
     * @return \Illuminate\Http\Response
     */
    public function show(VoluntarioPersona $voluntarioPersona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VoluntarioPersona  $voluntarioPersona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'cantidad'=> 'required|integer|min:1|max:30|regex:/[0-9]{1,30}/',
            'lugar'=> 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\s]+$/|string|max:255|min:3',
        ];
        $messages = [
            'cantidad.min' => 'Mínimo 1 actividad',
            'cantidad.max' => 'Maximo 30 actividades',
            'cantidad.*' => 'Se requiere una cantidad de actividades',
            'lugar.min' => 'Mínimo 3 caracteres',
            'lugar.max' => 'Maximo 30 caracteres',
            'lugar.*' => 'Se requiere un lugar de procedencia',
        ];
        $tag = $this->voluntarioPersona->findOrFail($id);
        $tag->update($request->all());
        return $this->sendResponse($tag, 'Voluntario Persona Actualizada');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoluntarioPersona  $voluntarioPersona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voluntarioPer = $this->voluntarioPersona->findOrFail($id);
        $voluntarioPer->delete();
        return $this->sendResponse($voluntarioPer, 'Voluntario Persona eliminada');
    }
}
