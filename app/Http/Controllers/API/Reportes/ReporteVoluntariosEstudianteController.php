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
    public function filtro(Request $request)
    {
        $filtro = $request->valor;
        $voluntarioActi = DB::table('voluntario_estudiantes')
        ->join('voluntarios', 'voluntario_estudiantes.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_estudiantes.*')->paginate($filtro);

        return $this->sendResponse($voluntarioActi, 'Registro Filtrado');
    }
    
    public function todo()
    {
        $voluntarioActi = DB::table('voluntario_estudiantes')
        ->join('voluntarios', 'voluntario_estudiantes.voluntariado_id', '=', 'voluntarios.id')
        ->select('voluntarios.*', 'voluntario_estudiantes.*')->get();

        return $this->sendResponse($voluntarioActi, 'Todo Registro');
    }
 

}
