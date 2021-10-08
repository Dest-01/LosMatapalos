<?php

namespace App\Http\Controllers\API\client;

use App\Models\Donativos;
use Illuminate\Http\Request;


class DonacionController extends BaseController
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
        $donativo = $this->donativos->latest()->paginate(5);
        
     

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
