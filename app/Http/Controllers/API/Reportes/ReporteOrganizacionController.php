<?php

namespace App\Http\Controllers\API\Reportes;


use App\Models\Organizaciones;
use Illuminate\Http\Request;
use DB;

class ReporteOrganizacionController extends BaseController
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
    public function filtro(Request $request)
    {
        $filtro = $request->valor;

        $organizacion = $this->organizaciones->latest()->paginate($filtro);

        return $this->sendResponse($organizacion, 'Registro Filtrado');
    }
    public function todo()
    {
        $organizacion = $this->organizaciones->get();

        return $this->sendResponse($organizacion, 'Todo Registro');
    }



}
