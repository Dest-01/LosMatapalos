<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Admin\ReservaRequest;
use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Models\Donativos;
use App\Models\Personas;
use App\Models\Organizaciones;

class ReservaController extends BaseController
{
    protected $personas = '';
    protected $organizaciones = '';
    protected $reserva = '';

    public function __construct(Reserva $reserva, Personas $personas, Organizaciones $organizaciones)
    {
        $this->middleware('auth:api');
        $this->reserva = $reserva;
        $this->personas = $personas;
        $this->organizaciones = $organizaciones;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = $this->reserva->latest()->with('personas', 'organizaciones')->paginate(10);
        //  $products = $this->product->latest()->with('category', 'tags')->paginate(10);
  
          return $this->sendResponse($reservas, 'Lista reservas');
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservaRequest $request)
    {
        $tag = $this->reserva->create([
            'idPersona' => $request->get('idPersona'),
            'idOrganizacion' => $request->get('idOrganizacion'),
            'cantidad' => $request->get('cantidad'),
            'fecha' => $request->get('fecha'),
            'horaInicio' => $request->get('horaInicio'),
            'horaFin' => $request->get('horaFin')
            
        ]);
        return $this->sendResponse($tag, 'Datos creados');
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

        return $this->sendResponse($tag, 'Datos Actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $reserva = $this->reserva->findOrFail($id);

        $reserva->delete();

        return $this->sendResponse($reserva, 'Datos eliminado');
    }
}
