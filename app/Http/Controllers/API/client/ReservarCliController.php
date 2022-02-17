<?php

namespace App\Http\Controllers\API\client;

use App\Http\Requests\Admin\GrupoRequest;
use App\Http\Requests\Admin\OrganizacionesRequest;
use App\Http\Requests\Admin\PersonasRequest;
use App\Http\Requests\Admin\ReservaRequest;
use App\Models\Grupo;
use App\Models\Organizaciones;
use App\Models\Personas;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservarCliController extends BaseController
{
    protected $personas = '';

    protected $reservarCli = '';

    protected $organizaciones = '';

    protected $grupos = '';

    public function __construct(Personas $personas, Reserva $reserva, Organizaciones $organizaciones, Grupo $grupos)
    {

        $this->personas = $personas;

        $this->reserva = $reserva;

        $this->organizaciones = $organizaciones;

        $this->grupos = $grupos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cedula)
    {
        //

    }

    public function store(ReservaRequest $request)
    {
        //  $indentificacionB = $request->buscador;

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

        return $this->sendResponse($tag, 'Se reservo con exito!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function GuardarPersona(PersonasRequest $request)
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

                return $this->sendResponse($tag, 'Registro exitoso!');
            } else {
                return response()->json(['success' => false, 'message' => 'Cedula ya existe!']);
            }

        } catch (\Exception$e) {
            return $e->getMessage();
        }

    }

    public function GuardarOrganizacion(OrganizacionesRequest $request)
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

                return $this->sendResponse($tag, 'Registro exitoso!');
            } else {
                return response()->json(['success' => false, 'message' => 'Cedula ya existe!']);
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

                return $this->sendResponse($tag, 'Registro exitoso!');
            } else {
                return response()->json(['success' => false, 'message' => 'Nombre ya existe!']);
            }

        } catch (\Exception$e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReservarCli  $reservarCli
     * @return \Illuminate\Http\Response
     */
    public function obtenerCedula(Request $request)
    {
        $filtro = $request->buscador;
        $persona = Personas::where('identificacion', $filtro)->get();
        return $this->sendResponse($persona, 'Cedula si existe!');

    }
    public function obtenerCedulaOrg(Request $request)
    {
        $filtro = $request->buscador;
        $organizacion = Organizaciones::where('identificacion', $filtro)->get();
        return $this->sendResponse($organizacion, 'Cedula si existe!');

    }

    public function obtenerNombreGrupo(Request $request)
    {
        $filtro = $request->buscador;
        $grupo = Grupo::where('nombre', $filtro)->get();
        return $this->sendResponse($grupo, 'Grupo si existe!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReservarCli  $reservarCli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReservarCli $reservarCli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReservarCli  $reservarCli
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReservarCli $reservarCli)
    {
        //
    }
}
