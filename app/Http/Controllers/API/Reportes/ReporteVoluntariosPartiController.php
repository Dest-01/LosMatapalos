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
    public function filtro(Request $request)
    {
        $filtro = $request->valor;
        $voluntarioActi = DB::table('voluntario_personas')
        ->join('voluntarios', 'voluntario_personas.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_personas.*')->paginate($filtro);

        return $this->sendResponse($voluntarioActi, 'Registro Filtrado');
    }
    public function todo()
    {
        $voluntarioActi = DB::table('voluntario_personas')
        ->join('voluntarios', 'voluntario_personas.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_personas.*')->get();


        return $this->sendResponse($voluntarioActi, 'Todo Registro');
    }
   

}
