<?php

namespace App\Http\Controllers\API\Reportes;


use App\Models\Fauna;
use Illuminate\Http\Request;
use DB;

class ReporteFaunaController extends BaseController
{

    protected $fauna = '';

    public function __construct(Fauna $fauna)
    {
        $this->middleware('auth:api');
        $this->fauna = $fauna;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtro(Request $request)
    {
        $filtro = $request->valor;

        $fauna = $this->fauna->latest()->paginate($filtro);

        return $this->sendResponse($fauna, 'Registro Filtrado');
    }
    public function todo()
    {
        $fauna = $this->fauna->get();

        return $this->sendResponse($fauna, 'Todo Registro');
    }

}
