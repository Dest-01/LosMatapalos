<?php

namespace App\Http\Controllers\API\client;

use App\Models\ActividadesPasadas;
use Illuminate\Http\Request;

class ActividadesPasadasController extends BaseController
{
    protected $actividadesPasadas = '';
    public function __construct(ActividadesPasadas $actividadesPasadas)
    {
        $this->actividadesPasadas = $actividadesPasadas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividadesP = $this->actividadesPasadas->latest()->paginate(8);
        return $this->sendResponse($actividadesP, 'Lista Actividades Pasadas');
    }

    public function list()
    {
        $actividadesP = $this->actividadesPasadas->get();
        
        return $this->sendResponse($actividadesP, 'Lista Actividades Pasadas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActividadesPasadas  $actividadesPasadas
     * @return \Illuminate\Http\Response
     */
    public function show(ActividadesPasadas $actividadesPasadas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActividadesPasadas  $actividadesPasadas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActividadesPasadas $actividadesPasadas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActividadesPasadas  $actividadesPasadas
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActividadesPasadas $actividadesPasadas)
    {
        //
    }
}
