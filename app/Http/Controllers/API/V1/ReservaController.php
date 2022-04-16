<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Admin\GrupoRequest;
use App\Http\Requests\Admin\OrganizacionesRequest;
use App\Http\Requests\Admin\PersonasRequest;
use App\Http\Requests\Admin\ReservaRequest;
use App\Models\Organizaciones;
use App\Models\Personas;
use App\Models\Grupo;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends BaseController
{
    protected $personas = '';
    protected $organizaciones = '';
    protected $reserva = '';
    protected $grupos = '';

    public function __construct(Reserva $reserva, Personas $personas, Organizaciones $organizaciones, Grupo $grupos)
    {
        $this->middleware('auth:api');
        $this->reserva = $reserva;
        $this->personas = $personas;
        $this->organizaciones = $organizaciones;
        $this->grupos = $grupos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = $this->reserva->latest()->with('personas', 'organizaciones')->paginate(10);

        return $this->sendResponse($reservas, 'Lista de reservas!');
    }

    public function mostrar(Request $request)
    {
        $filtro = $request->valor;

        $reservas = $this->reserva->latest()->paginate($filtro);

        return $this->sendResponse($reservas, 'Lista de reservas!');
    }

    function list() {
        $reservas = $this->reserva->get();

        return $this->sendResponse($reservas, 'Lista de todas las reservas!');
    }

    public function obtenerCedula(Request $request)
    {
        $filtro = $request->buscador;
        $persona = Personas::where('identificacion', $filtro)->select('id','identificacion','correo')->get();
        return $this->sendResponse($persona, 'Identifación si existe!');

    }
    public function obtenerCedulaOrg(Request $request)
    {
        $filtro = $request->buscador;
        $organizacion = Organizaciones::where('identificacion', $filtro)->select('id','identificacion','correo')->get();
        return $this->sendResponse($organizacion, 'Cédula jurídica si existe!');
    }

    public function obtenerNombreGrupo(Request $request)
    {
        $filtro = $request->buscador;
        $grupo = Grupo::where('nombre', $filtro)->select('id','nombre','correo')->get();
        return $this->sendResponse($grupo, 'Grupo si existe!');

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

                return $this->sendResponse($tag, 'Perosna registrada!');
            } else {
                return response()->json(['success' => false, 'message' => 'Identifación ya existe!']);
            }

        } catch (\Exception$e) {
            return $e->getMessage();
        }
    }

    public function guardarOrganizacion(OrganizacionesRequest $request)
    {
        try {
            $filtro = $request->identificacion;
            $existencia = Organizaciones::where('identificacion', '=', $filtro)->first();
            if ($existencia === null) {
                $tag = $this->organizaciones->create([
                    'identificacion' => $request->get('identificacion'),
                    'nombre' => $request->get('nombre'),
                    'telefono' => $request->get('telefono'),
                    'correo' => $request->get('correo'),
                ]);

                return $this->sendResponse($tag, 'Organización registrada!');
            } else {
                return response()->json(['success' => false, 'message' => 'Cédula jurídica ya existe!']);
            }

        } catch (\Exception$e) {
            return $e->getMessage();
        }

    }

    public function GuardarGrupo(GrupoRequest $request)
    {
        try {
            $filtro = $request->nombre;
            $existencia = Grupo::where('nombre', '=', $filtro)->first();
            if ($existencia === null) {
                $tag = $this->grupos->create([
                    'nombre' => $request->get('nombre'),
                    'correo' => $request->get('correo'),
                    'cantidad' => $request->get('cantidad'),
                    'edades' => $request->get('edades'),
                    'lugar' => $request->get('lugar'),
                    'tematica' => $request->get('tematica'),
                    'detalles' => $request->get('detalles'),
                ]);

                return $this->sendResponse($tag, 'Grupo registrado!');
            } else {
                return response()->json(['success' => false, 'message' => 'Nombre ya existe!']);
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
    public function store(ReservaRequest $request)
    {
        $tag = $this->reserva->create([
            'idPersona' => $request->get('idPersona'),
            'identificacionPersona' => $request->get('identificacionPersona'),
            'idOrganizacion' => $request->get('idOrganizacion'),
            'identificacionOrganizacion' => $request->get('identificacionOrganizacion'),
            'idGrupo' => $request->get('idGrupo'),
            'nombreGrupo' => $request->get('nombreGrupo'),
            'cantidad' => $request->get('cantidad'),
            'fecha' => $request->get('fecha'),
            'horaInicio' => $request->get('horaInicio'),
            'horaFin' => $request->get('horaFin'),

        ]);
        return $this->sendResponse($tag, 'Reserva realizada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(ReservaRequest $request, $id)
    {
        $tag = $this->reserva->findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Reserva actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $reserva = $this->reserva->findOrFail($id);

        $reserva->delete();

        return $this->sendResponse($reserva, 'Reserva eliminada!');
    }
}
