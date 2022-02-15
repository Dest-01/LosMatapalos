<?php

namespace App\Http\Controllers\API\client;

use App\Models\Fauna;
use Illuminate\Http\Request;


class FaunaController extends BaseController
{

    protected $fauna = '';

    public function __construct(Fauna $fauna)
    {
        $this->fauna = $fauna;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faunas = $this->fauna->latest()->paginate(6);
        
        return $this->sendResponse($faunas, 'Lista Fauna');
    }

    public function list()
    {
        $faunas = $this->fauna->get();
        
        return $this->sendResponse($faunas, 'Lista Fauna');
    }


    public function show($id)
    {
       //
    }

}
