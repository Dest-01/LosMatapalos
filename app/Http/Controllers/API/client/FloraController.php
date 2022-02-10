<?php

namespace App\Http\Controllers\API\client;

use App\Models\Flora;
use Illuminate\Http\Request;


class FloraController extends BaseController
{

    protected $flora = '';

    public function __construct(Flora $flora)
    {
        $this->flora = $flora;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $floras = $this->flora->latest()->paginate(8);
        
     

        return $this->sendResponse($floras, 'Lista Flora');
    }


    public function list()
    {
        $floras = $this->flora->get();
        
     

        return $this->sendResponse($floras, 'Lista Flora');
    }

    public function show($id)
    {
       //
    }

}
