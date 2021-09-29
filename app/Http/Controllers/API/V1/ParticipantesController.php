<?php

namespace App\Http\Controllers\API\V1;

use App\Models\participantes;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ParticipanteRequest;

class ParticipantesController extends BaseController
{
    protected $participantes = '';

    public function __construct(participantes $participantes)
    {
        $this->middleware('auth:api');
        $this->participantes = $participantes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participante = $this->participantes->latest()->paginate(10);

        return $this->sendResponse($participante, 'Lista de participantes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParticipanteRequest $request)
    {
        $filtro = $request->id;
        $existencia = participantes::find($filtro);

        if(empty($existencia)){
            
                $tag = $this->participantes->create([
                    'id' => $request->get('id'),
                    'nombre' => $request->get('nombre'),
                    'apellido1' => $request->get('apellido1'),
                    'apellido2' => $request->get('apellido2'),
                    'nacionalidad' => $request->get('nacionalidad'),
                    
                ]);
                return $this->sendResponse($tag, 'Datos registrados');
            }
            return $this->sendResponse($tag, 'Datos no registrados');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\participantes  $participantes
     * @return \Illuminate\Http\Response
     */
    public function show(participantes $participantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\participantes  $participantes
     * @return \Illuminate\Http\Response
     */
    public function update(ParticipanteRequest $request, $id)
    {
        $tag = $this->participantes->findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Datos actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\participantes  $participantes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $participantes = $this->participantes->findOrFail($id);

        $participantes->delete();

        return $this->sendResponse($participantes, 'Datos eliminados');
    }
}
