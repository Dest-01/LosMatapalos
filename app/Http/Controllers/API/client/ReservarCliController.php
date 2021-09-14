<?php

namespace App\Http\Controllers\API\client;

use App\Models\ReservarCli;
use App\Models\Personas;
use App\Models\Organizaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\PersonasRequest;

class ReservarCliController extends BaseController
{
    protected $personas = '';

    protected $reservarCli = '';

    protected $organizaciones = '';

    public function __construct(Personas $personas, ReservarCli $reservarCli, Organizaciones $organizaciones)
    {
        
        $this->personas = $personas;

        $this->reservarCli = $reservarCli;

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

        $tag = $this->reservarCli->create([
            'identificacion' => $request->get('identificacion'),
            'cantidad' => $request->get('cantidad'),
            'fecha' => $request->get('fecha'),
            'horaInicio' => $request->get('horaInicio'),
            'horaFin' => $request->get('horaFin'),
        ]);

        return $this->sendResponse($tag, 'Se reservo con exito');
    }

    




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function GuardarPersona(PersonasRequest $request)
    {
        //$filtro

        $tag = $this->personas->create([
            'id' => $request->get('id'),
            'nombre' => $request->get('nombre'),
            'apellido1' => $request->get('apellido1'),
            'apellido2' => $request->get('apellido2'),
            'telefono' => $request->get('telefono'),
            'correo' => $request->get('correo'),
        ]);

        return $this->sendResponse($tag, 'Registro completado con exito');
    }

    public function GuardarOrganizacion(Request $request)
    {
        $tag = $this->organizaciones->create([
            'id' => $request->get('id'),
            'nombre' => $request->get('nombre'),
            'telefono' => $request->get('telefono'),
            'correo' => $request->get('correo'),
        ]);

        return $this->sendResponse($tag, 'Registro completado con exito');
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
        $persona = Personas::where('id', $filtro)->get('id');
            return $this->sendResponse($persona, 'Cedula si existe');
        
       
    }
    public function obtenerCedulaOrg(Request $request)
    {
        $filtro = $request->buscador;
        $organizacion = Organizaciones::where('id', $filtro)->get('id');
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
