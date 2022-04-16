<?php

namespace App\Http\Controllers\API\Reportes;


use App\Models\Grupo;
use Illuminate\Http\Request;
use DB;

class ReporteGrupoController extends BaseController
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
    public function filtro(Request $request)
    {
        $filtro = $request->valor;

        $grupos = $this->grupos->latest()->paginate($filtro);

        return $this->sendResponse($grupos, 'Registro Filtrado');
    }
    public function todo()
    {
        $grupos = $this->grupos->get();

        return $this->sendResponse($grupos, 'Todo Registro');
    }

}
