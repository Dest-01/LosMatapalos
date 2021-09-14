<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Admin\OrganizacionesRequest;
use App\Models\Organizaciones;
use Illuminate\Http\Request;

class OrganizacionesController extends BaseController
{

    
    protected $organizaciones = '';

    public function __construct(Organizaciones $organizaciones)
    {
        $this->middleware('auth:api');
        $this->organizaciones = $organizaciones;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizacion = $this->organizaciones->latest()->paginate(10);

        return $this->sendResponse($organizacion, 'Lista de Organizaciones');
    }

    public function list()
    {
        $organizacion = $this->organizaciones->pluck('id', 'id');

        return $this->sendResponse($organizacion, 'Lista Organizaciones');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizacionesRequest $request)
    {
        $filtro = $request->id;
        $existencia = Organizaciones::find($filtro);

        if(empty($existencia)){
            
            $tag = $this->organizaciones->create([
                'id' => $request->get('id'),
                'nombre' => $request->get('nombre'),
                'telefono' => $request->get('telefono'),
                'correo' => $request->get('correo'),
            ]);
    
            return $this->sendResponse($tag, 'Organización creada');
            }
            return $this->sendResponse('Organización no creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organizaciones  $organizaciones
     * @return \Illuminate\Http\Response
     */
    public function show(Organizaciones $organizaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organizaciones  $organizaciones
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizacionesRequest $request, $id)
    {
        $tag = $this->organizaciones->findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Organización Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organizaciones  $organizaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $organizaciones = $this->organizaciones->findOrFail($id);

        $organizaciones->delete();

        return $this->sendResponse($organizaciones, 'Organización eliminada');
    }
}
