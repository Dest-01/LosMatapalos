<?php

namespace App\Http\Controllers\API\V1;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController
{

    public function TotalPersonas()
    {
        $total = DB::table('personas')->count();
        return $this->sendResponse($total, 'Total de personas');
    }
    public function TotalActividades()
    {
        $total = DB::table('actividades')->count();
        return $this->sendResponse($total, 'Total de actividades');
    }
    public function TotalReservaciones()
    {
        $total = DB::table('reservas')->count();
        return $this->sendResponse($total, 'Total de reservaciones');
    }
    public function TotalDonaciones()
    {
        $total = DB::table('donativos')->count();
        return $this->sendResponse($total, 'Total de donaciones');
    }
}