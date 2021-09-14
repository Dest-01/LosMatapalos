<?php

namespace App\Http\Controllers\API\V1;


use App\Models\Personas;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PersonasRequest;
use DB;

class PersonasController extends BaseController
{

    protected $personas = '';

    public function __construct(Personas $personas)
    {
        $this->middleware('auth:api');
        $this->personas = $personas;
    }

    public function list()
    {
        $persona = $this->personas->pluck('id', 'id');

        return $this->sendResponse($persona, 'Lista Personas');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persona = $this->personas->latest()->paginate(10);

        return $this->sendResponse($persona, 'Lista de Personas');
    }

    public function obtenerCedula(Request $request)
    {
        $filtro = $request->buscador;

        $persona = Personas::where('id', $filtro)->get('id');

        return $this->sendResponse($persona, 'Cedula si existe');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonasRequest $request)
    {
        $filtro = $request->id;
        $existencia = Personas::find($filtro);

        if(empty($existencia)){
            
                $tag = $this->personas->create([
                    'id' => $request->get('id'),
                    'nombre' => $request->get('nombre'),
                    'apellido1' => $request->get('apellido1'),
                    'apellido2' => $request->get('apellido2'),
                    'telefono' => $request->get('telefono'),
                    'correo' => $request->get('correo'),
                ]);
                return $this->sendResponse($tag, 'Registro creado');
            }
            return $this->sendResponse($tag, 'Registro no creado');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function show(Personas $personas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function update(PersonasRequest $request, $id)
    {
        $tag = $this->personas->findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Persona Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $personas = $this->personas->findOrFail($id);

        $personas->delete();

        return $this->sendResponse($personas, 'Persona eliminada');
    }
}
