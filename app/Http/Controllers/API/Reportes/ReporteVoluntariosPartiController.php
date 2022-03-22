<?php

namespace App\Http\Controllers\API\Reportes;


use App\Models\Actividades;
use Illuminate\Http\Request;
use DB;

class ReporteVoluntariosPartiController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function solo10()
    {
        $voluntarioActi = DB::table('voluntario_personas')
        ->join('voluntarios', 'voluntario_personas.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_personas.*')->paginate(10);

        return $this->sendResponse($voluntarioActi, 'Últimos 10');
    }
    public function todo()
    {
        $voluntarioActi = DB::table('voluntario_personas')
        ->join('voluntarios', 'voluntario_personas.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_personas.*')->get();


        return $this->sendResponse($voluntarioActi, 'Lista de todaos');
    }
    public function solo25()
    {
        $voluntarioActi = DB::table('voluntario_personas')
        ->join('voluntarios', 'voluntario_personas.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_personas.*')->paginate(25);

        return $this->sendResponse($voluntarioActi, 'Últimos 25');
    }
    public function solo50()
    {
        $voluntarioActi = DB::table('voluntario_personas')
        ->join('voluntarios', 'voluntario_personas.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_personas.*')->paginate(50);

        return $this->sendResponse($voluntarioActi, 'Últimos 50');
    }
    public function solo75()
    {
        $voluntarioActi = DB::table('voluntario_personas')
        ->join('voluntarios', 'voluntario_personas.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_personas.*')->paginate(75);

        return $this->sendResponse($voluntarioActi, 'Últimos 75');
    }
    public function solo100()
    {
        $voluntarioActi = DB::table('voluntario_personas')
        ->join('voluntarios', 'voluntario_personas.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_personas.*')->paginate(100);

        return $this->sendResponse($voluntarioActi, 'Últimos 100');
    }

}
