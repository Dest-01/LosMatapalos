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
    public function solo10()
    {
        $actividad = $this->actividades->latest()->paginate(10);

        return $this->sendResponse($actividad, 'Últimos 10');
    }
    public function todo()
    {
        $actividad = $this->actividades->get();

        return $this->sendResponse($actividad, 'Lista de todas las personas');
    }
    public function solo25()
    {
        $actividad = $this->actividades->latest()->paginate(25);

        return $this->sendResponse($actividad, 'Últimos 25');
    }
    public function solo50()
    {
        $actividad = $this->actividades->latest()->paginate(50);

        return $this->sendResponse($actividad, 'Últimos 50');
    }
    public function solo75()
    {
        $actividad = $this->actividades->latest()->paginate(75);

        return $this->sendResponse($actividad, 'Últimos 75');
    }
    public function solo100()
    {
        $actividad = $this->actividades->latest()->paginate(100);

        return $this->sendResponse($actividad, 'Últimos 100');
    }

}
