<?php

namespace App\Http\Controllers\API\Reportes;


use App\Models\Donativos;
use Illuminate\Http\Request;
use DB;

class ReportesDonativosController extends BaseController
{

    protected $donativos = '';

    public function __construct(Donativos $donativos)
    {
        $this->middleware('auth:api');
        $this->donativos = $donativos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtro(Request $request)
    {
        $filtro = $request->valor;

        $donativos = $this->donativos->latest()->paginate($filtro);

        return $this->sendResponse($donativos, 'Registro Filtrado');
    }
    public function todo()
    {
        $donativos = $this->donativos->get();

        return $this->sendResponse($donativos, 'Todo Registro');
    }

}
