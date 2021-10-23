<?php

namespace App\Http\Controllers\API\client;

use App\Models\CatDonativos;
use App\Models\Donativos;
use Illuminate\Support\Facades\DB;

class DonacionController extends BaseController
{

    protected $donativos = '';
    protected $catDonativos = '';

    public function __construct(Donativos $donativos, CatDonativos $catDonativos)
    {
        $this->donativos = $donativos;
        $this->catDonativos = $catDonativos;
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
    }
    public function cargarCategoriaDonativos()
    {
        $catDonativos = $this->catDonativos->latest()->paginate(3);

        return $this->sendResponse($catDonativos, 'Lista Donativos Necesarios');
    }

    public function Donadores()
    {

    }

    public function show($id)
    {
        //
    }

}
