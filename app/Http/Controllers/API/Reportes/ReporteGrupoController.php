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
    public function solo10()
    {
        $grupos = $this->grupos->latest()->paginate(10);

        return $this->sendResponse($grupos, 'Últimos 10');
    }
    public function todo()
    {
        $grupos = $this->grupos->get();

        return $this->sendResponse($grupos, 'Lista de todas las personas');
    }
    public function solo25()
    {
        $grupos = $this->grupos->latest()->paginate(25);

        return $this->sendResponse($grupos, 'Últimos 25');
    }
    public function solo50()
    {
        $grupos = $this->grupos->latest()->paginate(50);

        return $this->sendResponse($grupos, 'Últimos 50');
    }
    public function solo75()
    {
        $grupos = $this->grupos->latest()->paginate(75);

        return $this->sendResponse($grupos, 'Últimos 75');
    }
    public function solo100()
    {
        $grupos = $this->grupos->latest()->paginate(100);

        return $this->sendResponse($grupos, 'Últimos 100');
    }

}
