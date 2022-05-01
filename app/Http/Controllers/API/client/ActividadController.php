<?php

namespace App\Http\Controllers\API\client;

use App\Models\Actividades;
use Illuminate\Http\Request;


class ActividadController extends BaseController
{

    protected $actividades = '';

    public function __construct(Actividades $actividades)
    {
        $this->actividades = $actividades;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividad = $this->actividades->latest()->paginate(3);
        return $this->sendResponse($actividad, 'Lista de Actividades');
    }


    public function list()
    {
//
    }

    public function show($id)
    {
       //
    }

}
