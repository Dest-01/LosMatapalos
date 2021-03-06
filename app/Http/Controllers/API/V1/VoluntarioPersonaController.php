<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Admin\PersonasRequest;
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

    public function consultarCedula(Request $request)
    {
        try {
            $filtro = $request->buscador;
            $existencia = Personas::where('identificacion', '=', $filtro)->first();
            if ($existencia !== null) {
                return response()->json(['success' => true, 'message' => 'Identifación si existe!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Identifación no existe!']);
            }

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

    public function obtenerCedula(Request $request)
    {
        try {
            $filtro = $request->buscador;
            $persona = Personas::where('identificacion', $filtro)->select('id','identificacion','correo')->get();
            return $this->sendResponse($persona, 'Identifación si existe!');

        } catch (\Exception$e) {
            return $e->getMessage();
        }

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
        $voluntarioPer = $this->voluntarioPersona->latest()->paginate(25);

        return $this->sendResponse($voluntarioPer, 'Lista de personas de voluntario');
    }

    public function mostrar()
    {
        $filtro = $request->valor;

        $voluntarioPer = $this->voluntarioPersona->latest()->paginate($filtro);

        return $this->sendResponse($voluntarioPer, 'Lista de personas de voluntario');
    }

    function list() {
        $voluntarioPer = $this->voluntarioPersona->get();

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
            $filtro = $request->identificacion;
            $existencia = Personas::where('identificacion', '=', $filtro)->first();
            if ($existencia === null) {
                $tag = $this->personas->create([
                    'identificacion' => $request->get('identificacion'),
                    'nombre' => $request->get('nombre'),
                    'apellido1' => $request->get('apellido1'),
                    'apellido2' => $request->get('apellido2'),
                    'telefono' => $request->get('telefono'),
                    'correo' => $request->get('correo'),
                ]);

                return $this->sendResponse($tag, 'Persona registrada!');
            } else {
                return response()->json(['success' => false, 'message' => 'Identificación ya existe!']);
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
                'cantidad' => 'required|integer|min:0|max:900|',
                'lugar' => 'required|string|min:3|max:100|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\s])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]*)*)+$/',
                'idVoluntario' => 'required|integer|min:1|',
            ];
            $messages = [
                'cantidad.min' => 'Mínimo 0 actividad',
                'cantidad.max' => 'Máximo 900 actividades',
                'cantidad.*' => 'Se requiere una cantidad de actividades',
                'lugar.min' => 'Mínimo 3 caracteres',
                'lugar.max' => 'Máximo 70 caracteres',
                'lugar.*' => 'Se requiere un lugar de procedencia',
                'idVoluntario' => 'Mínimo 1 Id de voluntario',
                'idVoluntario.*' => 'Se requiere un Id de voluntario',
            ];
            $this->validate($request, $rules, $messages);

            $filtro = $request->idVoluntario;
            $filtro2 = $request->IdentificacionPer;
            $existencia = Voluntario::where('id', '=', $filtro)->first();
            $existencia2 = VoluntarioPersona::where('identificacionPersona', '=', $filtro2)->first();
            if ($existencia === null && $existencia2 === null) {
                $tag = $this->voluntarios->create([
                    'id' => $request->get('idVoluntario'),
                    'cantidad' => $request->get('cantidad'),
                ]);
                $tag = $this->voluntarioPersona->create([
                    'identificacion' => $request->get('identificacion'),
                    'identificacionPersona' => $request->get('identificacionPersona'),
                    'voluntariado_id' => $request->get('voluntariado_id'),
                    'lugar' => $request->get('lugar'),
                ]);
                return response()->json(['success' => true, 'message' => 'Se registro el voluntariado!']);
            } else {
                return response()->json(['success' => false, 'message' => 'El voluntario ya existe!']);
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
            'idVoluntario' => 'required|integer|min:1|',
            'cantidad' => 'required|integer|min:0|max:900|',
            'lugar' => 'required|string|min:3|max:100|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9]*)*)+$/',
        ];
        $messages = [
            'cantidad.min' => 'Mínimo 0 actividad',
            'cantidad.max' => 'Máximo 900 actividades',
            'cantidad.*' => 'Se requiere una cantidad de actividades',
            'lugar.min' => 'Mínimo 3 caracteres',
            'lugar.max' => 'Máximo 100 caracteres',
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
        return $this->sendResponse($voluntarioPer, 'Voluntario persona eliminada!');
    }
}
