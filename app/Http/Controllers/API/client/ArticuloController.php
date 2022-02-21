<?php

namespace App\Http\Controllers\API\client;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends BaseController
{

    protected $Articulos = '';
    
    public function __construct(Articulo $Articulos)
    {
        $this->articulo = $Articulos;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Articulos = $this->articulo->latest()->paginate(10);
        return $this->sendResponse($Articulos, 'Articulos de la marca!');
    }

}
