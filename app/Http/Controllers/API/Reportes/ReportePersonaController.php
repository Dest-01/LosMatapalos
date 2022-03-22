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
    public function solo10()
    {
        $persona = $this->personas->latest()->paginate(10);

        return $this->sendResponse($persona, 'Últimos 10');
    }
    public function todo()
    {
        $persona = $this->personas->get();

        return $this->sendResponse($persona, 'Lista de todas las personas');
    }
    public function solo25()
    {
        $persona = $this->personas->latest()->paginate(25);

        return $this->sendResponse($persona, 'Últimos 25');
    }
    public function solo50()
    {
        $persona = $this->personas->latest()->paginate(50);

        return $this->sendResponse($persona, 'Últimos 50');
    }
    public function solo75()
    {
        $persona = $this->personas->latest()->paginate(75);

        return $this->sendResponse($persona, 'Últimos 75');
    }
    public function solo100()
    {
        $persona = $this->personas->latest()->paginate(100);

        return $this->sendResponse($persona, 'Últimos 100');
    }

}
