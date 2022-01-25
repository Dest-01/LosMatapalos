<?php

namespace App\Http\Controllers\API\client;


use App\Models\RepositorioDocumentos;
use Illuminate\Http\Request;

class RepositorioController extends BaseController
{
    protected $personas = '';

    public function __construct(RepositorioDocumentos $repositorioDocumentos)
    {

        $this->repositorioDocumentos = new RepositorioDocumentos();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repositorioDocumentos = $this->repositorioDocumentos->latest()->paginate(5);
        return $this->sendResponse($repositorioDocumentos,"Lista de Repositorios");
    }

}
