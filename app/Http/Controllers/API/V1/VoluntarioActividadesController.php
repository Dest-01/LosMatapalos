<?php

namespace App\Http\Controllers\API\V1;

use App\Models\VoluntarioActividades;
use App\Models\actividades;
use App\Models\VoluntarioPersona;
use App\Models\VoluntarioEstudiantes;
use Illuminate\Http\Request;


class VoluntarioActividadesController extends BaseController
{   protected $voluntarioPersona = '';
    protected $voluntarioActividades = '';
    protected $voluntarioEstudiantes = '';
    protected $actividades = '';
    public function __construct(VoluntarioActividades $voluntarioActividades,VoluntarioPersona $voluntarioPersona,Actividades $actividades,VoluntarioEstudiantes $voluntarioEstudiantes)
    {
        $this->middleware('auth:api');
        $this->voluntarioActividades = $voluntarioActividades;
        $this->voluntarioPersona = $voluntarioPersona;
        $this->actividades = $actividades;
        $this->voluntarioEstudiantes = $voluntarioEstudiantes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(){
        $voluntarioActi = $this->voluntarioActividades->pluck('id','nombre');
        return $this->sendResponse($voluntarioActi, 'Lista de Voluntario Actividades');
    }
    public function index()
    {
       $voluntarioActi = $this->voluntarioActividades->latest()->paginate(10);
       return $this->sendResponse($voluntarioActi, 'Lista de Voluntario Actividades');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = $this->voluntarioActividades->create([
            'idActividad'=> $request->get('idActividad'),
            'idVoluntario_Persona'=> $request->get('idVoluntario_Persona'),
            'idVoluntario_Estudiante'=> $request->get('idVoluntario_Estudiante'),
        ]);
        return $this->sendResponse($tag, 'Actividad Voluntarios registrados');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoluntarioActividades  $voluntarioActividades
     * @return \Illuminate\Http\Response
     */
    public function show(VoluntarioActividades $voluntarioActividades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VoluntarioActividades  $voluntarioActividades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = $this->voluntarioActividades->findOrFail($id);
        $tag->update($request->all());
        return $this->sendResponse($tag, 'Activiadades Voluntarios Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoluntarioActividades  $voluntarioActividades
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoluntarioActividades $voluntarioActividades,$id)
    {
        $this->authorize('isAdmin');
        $voluntarioActividades = $this->voluntarioActividades->findOrFail($id);
        $voluntarioActividades->delete();
        return $this->sendResponse($voluntarioActividades, 'Datos Eliminados');
    }
    public function GetActividades(){
       $data = actividades::get();
       return response()->json($data);     
    }
    public function GetVoluntarioPersona(){
       $data = VoluntarioPersona::get();
       return response()->json($data);     
    }
    public function GetVoluntarioEstudiantes(){
       $data = VoluntarioEstudiantes::get();
       return response()->json($data);
    }
}
