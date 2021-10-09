<?php

namespace App\Http\Controllers\API\client;

use App\Models\Donativos;
use Illuminate\Http\Request;


class FloraController extends BaseController
{

    protected $donativos = '';

    public function __construct(Donativos $donativos)
    {
        $this->donativos = $donativos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donativo = $this->donativos->latest()->paginate(6);
        
     

        return $this->sendResponse($donativo, 'Lista Donativos');
    }


    public function list()
    {
//
    }

    public function show($id)
    {
       //
    }

}
