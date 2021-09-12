<?php

namespace App\Http\Controllers\API\client;

use App\Models\ReservarCli;
use App\Models\Personas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservarCliController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cedula)
    {
       //

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
     * @param  \App\Models\ReservarCli  $reservarCli
     * @return \Illuminate\Http\Response
     */
    public function show(ReservarCli $reservarCli, $cedula)
    {
        return DB::table('personas')->where('id', $cedula)->pluck('id');


        return $this->sendResponse('La cedula si existe');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReservarCli  $reservarCli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReservarCli $reservarCli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReservarCli  $reservarCli
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReservarCli $reservarCli)
    {
        //
    }
}
