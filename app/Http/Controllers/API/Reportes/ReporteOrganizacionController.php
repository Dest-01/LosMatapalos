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
    public function solo10()
    {
        $organizacion = $this->organizaciones->latest()->paginate(10);

        return $this->sendResponse($organizacion, 'Últimos 10');
    }
    public function todo()
    {
        $organizacion = $this->organizaciones->get();

        return $this->sendResponse($organizacion, 'Lista de todas las personas');
    }
    public function solo25()
    {
        $organizaciones = $this->organizaciones->latest()->paginate(25);

        return $this->sendResponse($organizaciones, 'Últimos 25');
    }
    public function solo50()
    {
        $organizaciones = $this->organizaciones->latest()->paginate(50);

        return $this->sendResponse($organizaciones, 'Últimos 50');
    }
    public function solo75()
    {
        $organizaciones = $this->organizaciones->latest()->paginate(75);

        return $this->sendResponse($organizaciones, 'Últimos 75');
    }
    public function solo100()
    {
        $organizaciones = $this->organizaciones->latest()->paginate(100);

        return $this->sendResponse($organizaciones, 'Últimos 100');
    }

}
