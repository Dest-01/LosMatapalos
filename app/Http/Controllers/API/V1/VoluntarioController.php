<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Voluntario;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\VoluntarioRequest;

class VoluntarioController extends BaseController
{
    protected $voluntario = '';

    public function __construct(Voluntario $voluntario)
    {
        $this->middleware('auth:api');
        $this->voluntario = $voluntario;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voluntarios = $this->voluntario->latest()->paginate(10);

        return $this->sendResponse($voluntarios, 'Lista de voluntariado');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoluntarioRequest $request)
    {
        $tag = $this->voluntario->create([
            'tipo' => $request->get('tipo'),
            'nombre' => $request->get('nombre'),
            'cantidad' => $request->get('cantidad')
            
        ]);
        return $this->sendResponse($tag, 'Voluntariado creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function show(Voluntario $voluntario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function update(VoluntarioRequest $request, $id)
    {
        $tag = $this->voluntario->findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Voluntariado Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $voluntario = $this->voluntario->findOrFail($id);

        $voluntario->delete();

        return $this->sendResponse($voluntario, 'Voluntariado eliminado');
    }
}
