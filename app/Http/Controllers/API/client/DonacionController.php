<?php

namespace App\Http\Controllers\API\client;

use App\Models\Personas;
use App\Models\Organizaciones;
use App\Models\CatDonativos;
use App\Models\Donativos;
use Illuminate\Support\Facades\DB;

class DonacionController extends BaseController
{

    protected $donativos = '';
    protected $catDonativos = '';
    protected $personas = '';
    protected $organizaciones = '';

    public function __construct(Donativos $donativos, CatDonativos $catDonativos, Personas $personas, Organizaciones $organizaciones)
    {
        $this->donativos = $donativos;
        $this->catDonativos = $catDonativos;
        $this->personas = $personas;
        $this->organizaciones = $organizaciones;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donativo = $this->donativos->latest()->paginate(8);

        return $this->sendResponse($donativo, 'Lista Donativos');

        $donativo = DB::table('donativos')
        ->join('personas', 'donativos.idPersona', '=', 'personas.id')
        ->join('organizaciones', 'donativos.idOrganizacion ', '=', 'organizaciones.id')
        ->select('personas.*', 'donativos.*', 'organizaciones.*')
        ->paginate(8);

    return $this->sendResponse($donativo, 'Lista de estudiantes voluntariados!');
    }
    public function cargarCategoriaDonativos()
    {
        $catDonativos = $this->catDonativos->latest()->paginate(3);

        return $this->sendResponse($catDonativos, 'Lista Donativos Necesarios');
    }

    public function show($id)
    {
        //
    }

}
