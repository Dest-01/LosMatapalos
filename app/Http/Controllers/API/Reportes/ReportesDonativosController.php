<?php

namespace App\Http\Controllers\API\Reportes;


use App\Models\Donativos;
use Illuminate\Http\Request;
use DB;

class ReportesDonativosController extends BaseController
{

    protected $donativos = '';

    public function __construct(Donativos $donativos)
    {
        $this->middleware('auth:api');
        $this->donativos = $donativos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function solo10()
    {
        $donativos = $this->donativos->latest()->paginate(10);

        return $this->sendResponse($donativos, 'Últimos 10');
    }
    public function todo()
    {
        $donativos = $this->donativos->get();

        return $this->sendResponse($donativos, 'Lista de todas las personas');
    }
    public function solo25()
    {
        $donativos = $this->donativos->latest()->paginate(25);

        return $this->sendResponse($donativos, 'Últimos 25');
    }
    public function solo50()
    {
        $donativos = $this->donativos->latest()->paginate(50);

        return $this->sendResponse($donativos, 'Últimos 50');
    }
    public function solo75()
    {
        $donativos = $this->donativos->latest()->paginate(75);

        return $this->sendResponse($donativos, 'Últimos 75');
    }
    public function solo100()
    {
        $donativos = $this->donativos->latest()->paginate(100);

        return $this->sendResponse($donativos, 'Últimos 100');
    }

}
