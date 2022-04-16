<?php

namespace App\Http\Controllers\API\Reportes;


use App\Models\Personas;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PersonasRequest;
use DB;

class ReportePersonaController extends BaseController
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
    public function filtro(Request $request)
    {
        $filtro = $request->valor;

        $persona = $this->personas->latest()->paginate($filtro);

        return $this->sendResponse($persona, 'Registro Filtrado');
    }
    public function todo()
    {
        $persona = $this->personas->get();

        return $this->sendResponse($persona, 'Todo Registro');
    }

}
