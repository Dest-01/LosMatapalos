<?php

namespace App\Http\Controllers\API\client;

use App\Http\Requests\Admin\PersonasRequest;
use App\Http\Requests\Admin\OrganizacionesRequest;
use App\Models\Organizaciones;
use App\Models\Personas;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservarCliController extends BaseController
{
    protected $personas = '';

    protected $reservarCli = '';

    protected $organizaciones = '';

    public function __construct(Personas $personas, Reserva $reserva, Organizaciones $organizaciones)
    {

        $this->personas = $personas;

        $this->reserva = $reserva;

        $this->organizaciones = $organizaciones;
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

    public function store(Request $request)
    {
        //  $indentificacionB = $request->buscador;

        $tag = $this->reserva->create([
            'idPersona' => $request->get('idPersona'),
            'idOrganizacion' => $request->get('idOrganizacion'),
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
            $tag = $this->personas->create([
                'id' => $request->get('id'),
                'nombre' => $request->get('nombre'),
                'apellido1' => $request->get('apellido1'),
                'apellido2' => $request->get('apellido2'),
                'telefono' => $request->get('telefono'),
                'correo' => $request->get('correo'),
            ]);
            return $this->sendResponse($tag, 'Datos registrados!');
        } catch (ModelNotFoundException $exception) {

            return $this->sendResponse($exception, 'Ya existe el registro!');

        }

    }

    public function GuardarOrganizacion(OrganizacionesRequest $request)
    {
        try {
            $tag = $this->organizaciones->create([
                'id' => $request->get('id'),
                'nombre' => $request->get('nombre'),
                'telefono' => $request->get('telefono'),
                'correo' => $request->get('correo'),
            ]);
            return $this->sendResponse($tag, 'Datos registrados!');
        } catch (ModelNotFoundException $exception) {
            return $this->sendResponse($exception, 'Ya existe el registro!');
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
        $persona = Personas::where('id', $filtro)->get();
        return $this->sendResponse($persona, 'Cedula si existe');

    }
    public function obtenerCedulaOrg(Request $request)
    {
        $filtro = $request->buscador;
        $organizacion = Organizaciones::where('id', $filtro)->get();
        return $this->sendResponse($organizacion, 'Cedula si existe');

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
