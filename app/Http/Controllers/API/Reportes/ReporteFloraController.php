<?php

namespace App\Http\Controllers\API\Reportes;


use App\Models\Flora;
use Illuminate\Http\Request;
use DB;

class ReporteFloraController extends BaseController
{

    protected $flora = '';

    public function __construct(Flora $flora)
    {
        $this->middleware('auth:api');
        $this->flora = $flora;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtro(Request $request)
    {
        $filtro = $request->valor;

        $flora = $this->flora->latest()->paginate($filtro);

        return $this->sendResponse($flora, 'Registro Filtrado');
    }
    public function todo()
    {
        $flora = $this->flora->get();

        return $this->sendResponse($flora, 'Todo Registro');
    }

}
