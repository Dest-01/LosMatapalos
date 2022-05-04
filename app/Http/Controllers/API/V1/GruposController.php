<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Admin\GrupoRequest;
use App\Models\Grupo;
use Illuminate\Http\Request;

class GruposController extends BaseController
{
    protected $grupos = '';

    public function __construct(Grupo $grupos)
    {
        $this->middleware('auth:api');
        $this->grupos = $grupos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupo = $this->grupos->latest()->paginate(10);

        return $this->sendResponse($grupo, 'Lista de grupos!');
    }

    public function mostrar(Request $request)
    {
        $filtro = $request->valor;

        $grupo = $this->grupos->latest()->paginate($filtro);

        return $this->sendResponse($grupo, 'Lista de grupos!');
    }

    function list() {
        $grupo = $this->grupos->get();

        return $this->sendResponse($grupo, 'Lista de todos los grupos!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GrupoRequest $request)
    {
        try {
            $filtro = $request->nombre;
            $existencia = Grupo::where('nombre', '=', $filtro)->first();
            if ($existencia === null) {
                $tag = $this->grupos->create([
                    'nombre' => $request->get('nombre'),
                    'correo' => $request->get('correo'),
                    'cantidad' => $request->get('cantidad'),
                    'edades' => $request->get('edades'),
                    'lugar' => $request->get('lugar'),
                    'tematica' => $request->get('tematica'),
                    'detalles' => $request->get('detalles'),
                ]);
                return $this->sendResponse($tag, 'Grupo registrado!');
            } else {
                return response()->json(['success' => false, 'message' => 'Nombre ya existe!']);
            }

        } catch (\Exception$e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(GrupoRequest $request, $id)
    {
        $tag = $this->grupos->findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Grupo actualizado!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $grupos = $this->grupos->findOrFail($id);

        $grupos->delete();

        return $this->sendResponse($grupos, 'Grupo eliminado!');
    }
}
