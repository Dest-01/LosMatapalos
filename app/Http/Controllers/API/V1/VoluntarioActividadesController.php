<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Actividades;
use App\Models\VoluntarioActividades;
use App\Models\VoluntarioEstudiantes;
use App\Models\VoluntarioPersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoluntarioActividadesController extends BaseController
{
    protected $voluntarioPersona = '';
    protected $voluntarioActividades = '';
    protected $voluntarioEstudiantes = '';
    protected $actividades = '';
    public function __construct(VoluntarioActividades $voluntarioActividades, VoluntarioPersona $voluntarioPersona, Actividades $actividades, VoluntarioEstudiantes $voluntarioEstudiantes)
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
    public function index()
    {
        $voluntarioActi = DB::table('voluntario_actividades')
            ->join('actividades', 'voluntario_actividades.idActividad', '=', 'actividades.id')
            ->join('voluntario_personas', 'voluntario_actividades.idVoluntario_Persona', '=', 'voluntario_personas.id')
            ->join('personas as per', 'voluntario_personas.identificacion', '=', 'per.id')
            ->join('voluntario_estudiantes', 'voluntario_actividades.idVoluntario_Estudiante', '=', 'voluntario_estudiantes.id')
            ->join('personas', 'voluntario_estudiantes.identificacion', '=', 'personas.id')
            ->select('voluntario_actividades.*', 'personas.nombre as NombrePersona', 'per.nombre as NombreEstudiante', 'personas.apellido1 as PrimerApePersona',
                'actividades.id as ActId', 'actividades.nombre as ActNombre', 'voluntario_personas.identificacion as VolPerId',
                'voluntario_personas.identificacionPersona as VolPerCedula', 'voluntario_estudiantes.identificacion as volEstId',
                'voluntario_estudiantes.identificacionPersona as volEstCedula', 'voluntario_estudiantes.identificacionPersona as volEstCedula')
            ->paginate(10);

        return $this->sendResponse($voluntarioActi, 'Lista de Voluntario Actividades!');
    }

    public function mostrar()
    {
        $filtro = $request->valor;

        $voluntarioActi = DB::table('voluntario_actividades')
            ->join('actividades', 'voluntario_actividades.idActividad', '=', 'actividades.id')
            ->join('voluntario_personas', 'voluntario_actividades.idVoluntario_Persona', '=', 'voluntario_personas.id')
            ->join('personas as per', 'voluntario_personas.identificacion', '=', 'per.id')
            ->join('voluntario_estudiantes', 'voluntario_actividades.idVoluntario_Estudiante', '=', 'voluntario_estudiantes.id')
            ->join('personas', 'voluntario_estudiantes.identificacion', '=', 'personas.id')
            ->select('voluntario_actividades.*', 'personas.nombre as NombrePersona', 'per.nombre as NombreEstudiante', 'personas.apellido1 as PrimerApePersona',
                'actividades.id as ActId', 'actividades.nombre as ActNombre', 'voluntario_personas.identificacion as VolPerId',
                'voluntario_personas.identificacionPersona as VolPerCedula', 'voluntario_estudiantes.identificacion as volEstId',
                'voluntario_estudiantes.identificacionPersona as volEstCedula', 'voluntario_estudiantes.identificacionPersona as volEstCedula')
            ->paginate($filtro);

        return $this->sendResponse($voluntarioActi, 'Lista de Voluntario Actividades!');
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
            'idActividad' => $request->get('idActividad'),
            'idVoluntario_Persona' => $request->get('idVoluntario_Persona'),
            'idVoluntario_Estudiante' => $request->get('idVoluntario_Estudiante'),
        ]);
        return $this->sendResponse($tag, 'Actividad voluntarios registradas!');
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
        return $this->sendResponse($tag, 'Activiadades voluntarios Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoluntarioActividades  $voluntarioActividades
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoluntarioActividades $voluntarioActividades, $id)
    {
        $voluntarioActividades = $this->voluntarioActividades->findOrFail($id);
        $voluntarioActividades->delete();
        return $this->sendResponse($voluntarioActividades, 'Activiadades voluntario Eliminado!');
    }
    public function GetActividades()
    {
        $data = actividades::get();
        return response()->json($data);
    }
    public function GetVoluntarioPersona()
    {
        $data = VoluntarioPersona::get();
        return response()->json($data);
    }
    public function GetVoluntarioEstudiantes()
    {
        $data = VoluntarioEstudiantes::get();
        return response()->json($data);
    }
}
