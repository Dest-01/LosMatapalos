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
    public function list()
    {
        $persona = $this->personas->get();

        return $this->sendResponse($persona, 'Lista de Personas');
    }

    public function obtenerCedula(Request $request)
    {
        $filtro = $request->buscador;

        $persona = Personas::where('identificacion', $filtro)->get('identificacion');

        return $this->sendResponse($persona, 'Cedula si existe!');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonasRequest $request)
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
                }else{
                    return response()->json(['success' => false, 'message' => 'Cedula ya existe!']);
                }
    
            } catch (\Exception $e) {
                return $e->getMessage();
            }
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

        return $this->sendResponse($tag, 'Datos actualizados!');
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

        return $this->sendResponse($personas, 'Datos eliminados!');
    }
}
