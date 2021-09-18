<?php

namespace App\Http\Controllers\API\V1;

use App\Models\VoluntarioPersona;
use Illuminate\Http\Request;
use App\Http\Requests\admin\VoluntarioPersonaRequest;
use App\Models\Personas;
use App\Models\Voluntario;



class VoluntarioPersonaController extends BaseController
{

    protected $personas = '';
    protected $voluntarios = '';
    protected $voluntarioPersonas = '';

    public function __construct(VoluntarioPersona $voluntarioPersona, Personas $personas, Voluntarios $voluntarios)
    {
        $this->middleware('auth:api');
        $this->voluntarioPersonas = $voluntarioPersonas;
        $this->personas = $personas;
        $this->voluntarios = $voluntarios;
    }

    public function obtenerCedula(Request $request)
    {
        $filtro = $request->buscador;
        $persona = Personas::where('id', $filtro)->get('id');
            return $this->sendResponse($persona, 'Cedula si existe');
        
       
    }

    public function obtenerNombreVoluntario(Request $request)
    {
        $filtro = $request->nombreVoluntario;
        $voluntario = Voluntario::where('id', $filtro)->get('id','nombre');
            return $this->sendResponse($voluntario, 'Voluntario si existe');
        
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voluntarioPer = $this->voluntarioPersonas->latest()->paginate(10);

        return $this->sendResponse($voluntarioPer, 'Lista de personas de voluntario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = $this->voluntarioPersonas->create([
            'identificacion' => $request->get('identificacion'),
            'voluntariado_id' => $request->get('voluntariado_id'),
        ]);

        return $this->sendResponse($tag, 'Voluntario persona creado');
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
        $tag = $this->voluntarioPersonas->findOrFail($id);

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
        $this->authorize('isAdmin');

        $voluntarioPer = $this->voluntarioPersonas->findOrFail($id);

        $voluntarioPer->delete();

        return $this->sendResponse($voluntarioPer, 'Voluntario Persona eliminada');
    }
}
