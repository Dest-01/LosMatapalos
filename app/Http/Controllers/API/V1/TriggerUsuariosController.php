<?php

namespace App\Http\Controllers\API\V1;

use App\Models\TriggerUsuarios;
use Illuminate\Http\Request;

class TriggerUsuariosController extends Controller
{

    protected $triggerUsuarios = '';

    public function __construct(TriggerUsuarios $triggerUsuarios)
    {
        $this->middleware('auth:api');
        $this->triggerUsuarios = $triggerUsuarios;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $triggerUsuario = $this->triggerUsuarios->latest()->paginate(25);

        return $this->sendResponse($triggerUsuario, 'Historia');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = $this->triggerUsuarios->create([
            'usuarioActivo' => $request->get('usuarioActivo'),
            'usuarioModificado' => $request->get('usuarioModificado'),
            'accion' => $request->get('accion'),
            'fecha' => $request->get('fecha'),
            'hora' => $request->get('hora'),

        ]);
        return $this->sendResponse($tag, 'Historial registrado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TriggerUsuarios  $triggerUsuarios
     * @return \Illuminate\Http\Response
     */
    public function show(TriggerUsuarios $triggerUsuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TriggerUsuarios  $triggerUsuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TriggerUsuarios $triggerUsuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TriggerUsuarios  $triggerUsuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(TriggerUsuarios $triggerUsuarios)
    {
        //
    }
}
