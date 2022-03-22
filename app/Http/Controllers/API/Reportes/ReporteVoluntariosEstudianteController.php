<?php

namespace App\Http\Controllers\API\Reportes;


use Illuminate\Http\Request;
use DB;

class ReporteVoluntariosEstudianteController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function solo10()
    {
        $voluntarioActi = DB::table('voluntario_estudiantes')
        ->join('voluntarios', 'voluntario_estudiantes.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_estudiantes.*')->paginate(10);

        return $this->sendResponse($voluntarioActi, 'Últimos 10');
    }
    
    public function todo()
    {
        $voluntarioActi = DB::table('voluntario_estudiantes')
        ->join('voluntarios', 'voluntario_estudiantes.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_estudiantes.*')->get();

        return $this->sendResponse($voluntarioActi, 'Lista de todos');
    }
    public function solo25()
    {
        $voluntarioActi = DB::table('voluntario_estudiantes')
        ->join('voluntarios', 'voluntario_estudiantes.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_estudiantes.*')->paginate(25);

        return $this->sendResponse($voluntarioActi, 'Últimos 25');
    }
    public function solo50()
    {
        $voluntarioActi = DB::table('voluntario_estudiantes')
        ->join('voluntarios', 'voluntario_estudiantes.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_estudiantes.*')->paginate(50);

        return $this->sendResponse($voluntarioActi, 'Últimos 50');
    }
    public function solo75()
    {
        $voluntarioActi = DB::table('voluntario_estudiantes')
        ->join('voluntarios', 'voluntario_estudiantes.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_estudiantes.*')->paginate(75);

        return $this->sendResponse($voluntarioActi, 'Últimos 75');
    }
    public function solo100()
    {
        $voluntarioActi = DB::table('voluntario_estudiantes')
        ->join('voluntarios', 'voluntario_estudiantes.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_estudiantes.*')->paginate(100);

        return $this->sendResponse($voluntarioActi, 'Últimos 100');
    }

}
