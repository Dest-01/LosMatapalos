<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Voluntario;
use App\Models\ActividadesParticipantes;
use Illuminate\Http\Request;

class ActividadesParticipantesController extends BaseController
{

    protected $actividadesParticipantes = '';
    public function __construct(ActividadesParticipantes $actividadesParticipantes)
    {
        $this->middleware('auth:api');
        $this->actividadesParticipantes = $actividadesParticipantes;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetVoluntarios()
    {
        $data= Voluntario::get();
        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividadesParticipantes = $this->actividadesParticipantes->latest()->paginate(10);
        return $this->sendResponse($actividadesParticipantes, 'Personas en actividades!');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filtro = $request->idVoluntario;
        $existencia = ActividadesParticipantes::find($filtro);
        if(empty($existencia))
        {
            $tag = $this->actividadesParticipantes->create([
                'idVoluntario' => $request->get('idVoluntario'),
                'idActividad' => $request->get('idActividad'),
            ]);
            return $this->sendResponse($tag, 'Participante añadido a actividad!');
        }
        return this->sendResponse('','Error al anadir a actividad!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActividadesParticipantes  $actividadesParticipantes
     * @return \Illuminate\Http\Response
     */
    public function show(ActividadesParticipantes $actividadesParticipantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActividadesParticipantes  $actividadesParticipantes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = $this->actividadesParticipantes->findOrFail($id);
        $tag->update($request->all());
        return $this->sendResponse($tag, 'Subscripción actualizada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActividadesParticipantes  $actividadesParticipantes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $actividadesParticipantes = $this->actividadesParticipantes->findOrFail($id);

        $actividadesParticipantes->delete();

        return $this->sendResponse($actividadesParticipantes, 'Subscripción eliminada!');
    }
}
