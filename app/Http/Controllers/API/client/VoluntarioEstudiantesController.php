<?php

namespace App\Http\Controllers\API\client;

use App\Models\VoluntarioEstudiantes;
use App\Models\Personas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VoluntarioEstudiantesController extends BaseController
{

    protected $personas = '';
    protected $voluntarioEstudiantes = '';

    public function __construct(VoluntarioEstudiantes $voluntarioEstudiantes, Personas $personas )
    {
        $this->voluntarioEstudiantes = $voluntarioEstudiantes;
        $this->personas = $personas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voluntarioEstudiantes = DB::table('voluntario_estudiantes')
        ->join('personas', 'voluntario_estudiantes.identificacion', '=', 'personas.id')
        ->select('personas.nombre', 'personas.apellido1', 'personas.apellido2','voluntario_estudiantes.imagen', 'voluntario_estudiantes.id', 'voluntario_estudiantes.carrera')
        ->paginate(8);

    return $this->sendResponse($voluntarioEstudiantes, 'Lista de estudiantes voluntariados!');
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
