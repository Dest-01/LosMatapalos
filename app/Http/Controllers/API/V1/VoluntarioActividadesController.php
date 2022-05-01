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
            ->join('actividades', 'voluntario_actividades.idActividad', '=', 'actividades.id')// relacionamos el id de actividades con voluntariado actividades
            ->join('voluntario_personas', 'voluntario_actividades.idVoluntario_Persona', '=', 'voluntario_personas.id')//Voluntario Persona con Voluntario Actividad
            ->join('personas as perVoluntarias', 'voluntario_personas.identificacion', '=', 'perVoluntarias.id')//Personas con VOluntario Personas
            ->join('voluntario_estudiantes', 'voluntario_actividades.idVoluntario_Estudiante', '=', 'voluntario_estudiantes.id')//Estudiantes con Voluntario Actividades
            ->join('personas as perEstudiante', 'voluntario_estudiantes.identificacion', '=', 'perEstudiante.id')//Persona con Estudiante
            ->join('voluntarios as voluntariosEst', 'voluntario_estudiantes.voluntariado_id', '=', 'voluntariosEst.id')//Persona con Estudiante
            ->join('voluntarios as voluntariosPer', 'voluntario_personas.voluntariado_id', '=', 'voluntariosPer.id')//Persona con Estudiante
            ->select('voluntario_actividades.*', 'voluntariosEst.cantidad as VoluntarioEstCantidad', 'voluntariosPer.cantidad as VoluntarioPerCantidad', 'perVoluntarias.nombre as NombrePersona', 'perVoluntarias.apellido1 as ApellidoPersona',
                'perEstudiante.nombre as NombreEstudiante', 'perEstudiante.apellido1 as ApellidoEstudiante',
                'actividades.id as ActId', 'actividades.nombre as ActNombre', 'actividades.cantParticipantes as ActCupos', 'voluntario_personas.identificacion as VolPerId',
                'voluntario_personas.identificacionPersona as VolPerCedula', 'voluntario_estudiantes.identificacion as volEstId',
                'voluntario_estudiantes.identificacionPersona as volEstCedula', 'voluntario_estudiantes.identificacionPersona as volEstCedula')
            ->paginate(10);

        return $this->sendResponse($voluntarioActi, 'Lista de Voluntario Actividades!');
    }

    public function mostrar(Request $request)
    {
        $filtro = $request->valor;

        $voluntarioActi = DB::table('voluntario_actividades')
            ->join('actividades', 'voluntario_actividades.idActividad', '=', 'actividades.id')// relacionamos el id de actividades con voluntariado actividades
            ->join('voluntario_personas', 'voluntario_actividades.idVoluntario_Persona', '=', 'voluntario_personas.id')//Voluntario Persona con Voluntario Actividad
            ->join('personas as perVoluntarias', 'voluntario_personas.identificacion', '=', 'perVoluntarias.id')//Personas con VOluntario Personas
            ->join('voluntario_estudiantes', 'voluntario_actividades.idVoluntario_Estudiante', '=', 'voluntario_estudiantes.id')//Estudiantes con Voluntario Actividades
            ->join('personas as perEstudiante', 'voluntario_estudiantes.identificacion', '=', 'perEstudiante.id')//Persona con Estudiante
            ->select('voluntario_actividades.*', 'perVoluntarias.nombre as NombrePersona', 'perVoluntarias.apellido1 as ApellidoPersona',
                'perEstudiante.nombre as NombreEstudiante', 'perEstudiante.apellido1 as ApellidoEstudiante',
                'actividades.id as ActId', 'actividades.nombre as ActNombre','actividades.cantParticipantes as ActCupos', 'voluntario_personas.identificacion as VolPerId',
                'voluntario_personas.identificacionPersona as VolPerCedula', 'voluntario_estudiantes.identificacion as volEstId',
                'voluntario_estudiantes.identificacionPersona as volEstCedula', 'voluntario_estudiantes.identificacionPersona as volEstCedula')
            ->paginate($filtro);

        return $this->sendResponse($voluntarioActi, 'Lista de Voluntario Actividades!');
    }

    public function list()
    {
        $voluntarioActi = DB::table('voluntario_actividades')
        ->join('actividades', 'voluntario_actividades.idActividad', '=', 'actividades.id')// relacionamos el id de actividades con voluntariado actividades
        ->join('voluntario_personas', 'voluntario_actividades.idVoluntario_Persona', '=', 'voluntario_personas.id')//Voluntario Persona con Voluntario Actividad
        ->join('personas as perVoluntarias', 'voluntario_personas.identificacion', '=', 'perVoluntarias.id')//Personas con VOluntario Personas
        ->join('voluntario_estudiantes', 'voluntario_actividades.idVoluntario_Estudiante', '=', 'voluntario_estudiantes.id')//Estudiantes con Voluntario Actividades
        ->join('personas as perEstudiante', 'voluntario_estudiantes.identificacion', '=', 'perEstudiante.id')//Persona con Estudiante
        ->select('voluntario_actividades.*', 'perVoluntarias.nombre as NombrePersona', 'perVoluntarias.apellido1 as ApellidoPersona',
            'perEstudiante.nombre as NombreEstudiante', 'perEstudiante.apellido1 as ApellidoEstudiante',
            'actividades.id as ActId', 'actividades.nombre as ActNombre', 'actividades.cantParticipantes as ActCupos', 'voluntario_personas.identificacion as VolPerId',
            'voluntario_personas.identificacionPersona as VolPerCedula', 'voluntario_estudiantes.identificacion as volEstId',
            'voluntario_estudiantes.identificacionPersona as volEstCedula', 'voluntario_estudiantes.identificacionPersona as volEstCedula')
        ->get();

    return $this->sendResponse($voluntarioActi, 'Lista de Voluntario Actividades!');
    }


    public function listarVoluntarioEstudiantes()
    {
        $voluntarioActi = DB::table('voluntario_estudiantes')
            ->join('personas as perEstudiante', 'voluntario_estudiantes.identificacion', '=', 'perEstudiante.id')//Persona con Estudiante
            ->join('voluntarios', 'voluntario_estudiantes.voluntariado_id', '=', 'voluntarios.id')//Voluntario con Estudiante
            ->select('perEstudiante.*', 'voluntario_estudiantes.id as VolEstID', 'voluntario_estudiantes.voluntariado_id as voluntariadoID','voluntarios.cantidad as cantidadActividad')
            ->get();
        return $this->sendResponse($voluntarioActi, 'Lista de Voluntario Estudiantes!');
    }

    public function listarVoluntarioPersonas()
    {
        $voluntarioActi = DB::table('voluntario_personas')
            ->join('personas as perVoluntariados', 'voluntario_personas.identificacion', '=', 'perVoluntariados.id')//Persona con Voluntariado
            ->join('voluntarios', 'voluntario_personas.voluntariado_id', '=', 'voluntarios.id')//Voluntario con Persona
            ->select('perVoluntariados.*','voluntario_personas.id as VolPerID', 'voluntario_personas.voluntariado_id as voluntariadoID','voluntarios.cantidad as cantidadActividad')
            ->get();
        return $this->sendResponse($voluntarioActi, 'Lista de Personas Voluntariadas!');
    }

    public function valorCupos(Request $request)
    {
        $filtro = $request->idAct;
        $CuposNuevo = $request->Cupos;
            $voluntarioActi = DB::table('actividades')
            ->where('id', $filtro)
            ->update(['cantParticipantes' => $CuposNuevo]);

        return $this->sendResponse($voluntarioActi, 'Accion realizada!');
    }

    public function valorPerVolunt(Request $request)
    {
        $filtro = $request->idVoluntarioPer;
        $cantidadPer = $request->CantidadPer;

            $voluntarioActi = DB::table('voluntarios')
            ->where('id', $filtro)
            ->update(['cantidad' => $cantidadPer]);

        return $this->sendResponse($voluntarioActi, 'Accion realizada!');
    }

    public function valorEstVolunt(Request $request)
    {
        $filtro = $request->idVoluntarioEst;
        $cantidadEst = $request->CantidadEst;

            $voluntarioActi = DB::table('voluntarios')
            ->where('id', $filtro)
            ->update(['cantidad' => $cantidadEst]);

        return $this->sendResponse($voluntarioActi, 'Accion realizada!');

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

}
