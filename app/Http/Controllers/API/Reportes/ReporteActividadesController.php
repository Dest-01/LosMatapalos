<?php

namespace App\Http\Controllers\API\Reportes;


use App\Models\Actividades;
use Illuminate\Http\Request;
use DB;

class ReporteActividadesController extends BaseController
{

    protected $actividades = '';

    public function __construct(Actividades $actividades)
    {
        $this->middleware('auth:api');
        $this->actividades = $actividades;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtro(Request $request)
    {
        $filtro = $request->valor;

        $actividad = $this->actividades->latest()->paginate($filtro);

        return $this->sendResponse($actividad, 'Registro Filtrado');
    }
    public function todo()
    {
        $actividad = $this->actividades->latest()->paginate();

        return $this->sendResponse($actividad, 'Todo Registro');
    }





}
