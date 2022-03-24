<?php

namespace App\Http\Controllers\API\client;

use App\Models\CatDonativos;
use App\Models\Donativos;
use App\Models\Organizaciones;
use App\Models\Personas;
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
        $donativo = DB::table('donativos')
            ->join('personas', 'donativos.idPersona', '=', 'personas.id')
            ->select('personas.*', 'donativos.*')
            ->paginate(5);

        return $this->sendResponse($donativo, 'Lista de ultimos donativos!');
    }

    public function ShowOrg()
    {
        $donativo = DB::table('donativos')
            ->join('organizaciones', 'donativos.idOrganizacion', '=', 'organizaciones.id')
            ->select('organizaciones.*', 'donativos.*')
            ->paginate(5);

        return $this->sendResponse($donativo, 'Lista de ultimos donativos!');
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
