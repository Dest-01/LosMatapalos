<?php

namespace App\Http\Controllers\API\Reportes;


use App\Http\Requests\Admin\ParticipanteRequest;
use App\Models\participantes;
use Illuminate\Http\Request;
use DB;

class ReporteParticipantesController extends BaseController
{

    protected $participantes = '';

    public function __construct(participantes $participantes)
    {
        $this->middleware('auth:api');
        $this->participantes = $participantes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtro(Request $request)
    {
        $filtro = $request->valor;

        $participante = $this->participantes->latest()->paginate($filtro);

        return $this->sendResponse($participante, 'Registro Filtrado');
    }
    public function todo()
    {
        $participante = $this->participantes->get();

        return $this->sendResponse($participante, 'Todo Registro');
    }

}
