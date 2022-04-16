<?php

namespace App\Http\Controllers\API\Reportes;


use App\Models\Reserva;
use Illuminate\Http\Request;
use DB;

class ReporteReservasController extends BaseController
{

    protected $reserva = '';

    public function __construct(Reserva $reserva)
    {
        $this->middleware('auth:api');
        $this->reserva = $reserva;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtro(Request $request)
    {
        $filtro = $request->valor;

        $reservas = $this->reserva->latest()->paginate($filtro);

        return $this->sendResponse($reservas, 'Registro Filtrado');
    }
    public function todo()
    {
        $reservas = $this->reserva->get();

        return $this->sendResponse($reservas, 'Todo Registro');
    }
}
