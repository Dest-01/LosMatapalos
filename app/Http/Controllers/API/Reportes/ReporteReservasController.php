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
    public function solo10()
    {
        $reservas = $this->reserva->latest()->paginate(10);

        return $this->sendResponse($reservas, 'Últimos 10');
    }
    public function todo()
    {
        $reservas = $this->reserva->get();

        return $this->sendResponse($reservas, 'Lista de todas las personas');
    }
    public function solo25()
    {
        $reservas = $this->reserva->latest()->paginate(25);

        return $this->sendResponse($reservas, 'Últimos 25');
    }
    public function solo50()
    {
        $reservas = $this->reserva->latest()->paginate(50);

        return $this->sendResponse($reservas, 'Últimos 50');
    }
    public function solo75()
    {
        $reservas = $this->reserva->latest()->paginate(75);

        return $this->sendResponse($reservas, 'Últimos 75');
    }
    public function solo100()
    {
        $reservas = $this->reserva->latest()->paginate(100);

        return $this->sendResponse($reservas, 'Últimos 100');
    }

}
