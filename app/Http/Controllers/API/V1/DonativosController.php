<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Admin\DonativosRequest;
use App\Models\Donativos;
use Illuminate\Http\Request;

class DonativosController extends BaseController
{
    protected $donativos = '';

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Donativos $donativos)
    {
        $this->middleware('auth:api');
        $this->donativos = $donativos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donativo = $this->donativos->latest()->paginate(10);

        return $this->sendResponse($donativo, 'Donation list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = $this->donativos->create([
            'nombre' => $request->get('nombre'),
            'tipo' => $request->get('tipo'),
            'descripcion' => $request->get('descripcion'),
            'fecha' => $request->get('fecha'),
        ]);

        return $this->sendResponse($tag, 'Donation Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donativos  $donativos
     * @return \Illuminate\Http\Response
     */
    public function show(Donativos $donativos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donativos  $donativos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = $this->donativos->findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Donation Information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donativos  $donativos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $donativos = $this->donativos->findOrFail($id);

        $donativos->delete();

        return $this->sendResponse($donativos, 'Donation has been Deleted');
    }
}
