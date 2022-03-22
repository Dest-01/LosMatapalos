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
    public function solo10()
    {
        $flora = $this->flora->latest()->paginate(10);

        return $this->sendResponse($flora, 'Últimos 10');
    }
    public function todo()
    {
        $flora = $this->flora->get();

        return $this->sendResponse($flora, 'Lista de todas las personas');
    }
    public function solo25()
    {
        $flora = $this->flora->latest()->paginate(25);

        return $this->sendResponse($flora, 'Últimos 25');
    }
    public function solo50()
    {
        $flora = $this->flora->latest()->paginate(50);

        return $this->sendResponse($flora, 'Últimos 50');
    }
    public function solo75()
    {
        $flora = $this->flora->latest()->paginate(75);

        return $this->sendResponse($flora, 'Últimos 75');
    }
    public function solo100()
    {
        $flora = $this->flora->latest()->paginate(100);

        return $this->sendResponse($flora, 'Últimos 100');
    }

}
