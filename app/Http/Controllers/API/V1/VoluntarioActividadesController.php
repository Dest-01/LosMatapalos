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
            ->leftJoin('actividades', 'voluntario_actividades.idActividad', '=', 'actividades.id') // relacionamos el id de actividades con voluntariado actividades
            ->leftJoin('voluntario_personas', 'voluntario_actividades.idVoluntario_Persona', '=', 'voluntario_personas.id') //Voluntario Persona con Voluntario Actividad
            ->leftJoin('personas as perVoluntarias', 'voluntario_personas.identificacion', '=', 'perVoluntarias.id') //Personas con VOluntario Personas
            ->leftJoin('voluntario_estudiantes', 'voluntario_actividades.idVoluntario_Estudiante', '=', 'voluntario_estudiantes.id') //Estudiantes con Voluntario Actividades
            ->leftJoin('personas as perEstudiante', 'voluntario_estudiantes.identificacion', '=', 'perEstudiante.id') //Persona con Estudiante
            ->leftJoin('voluntarios as voluntariosEst', 'voluntario_estudiantes.voluntariado_id', '=', 'voluntariosEst.id') //Persona con Estudiante
            ->leftJoin('voluntarios as voluntariosPer', 'voluntario_personas.voluntariado_id', '=', 'voluntariosPer.id') //Persona con Estudiante
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
            ->join('actividades', 'voluntario_actividades.idActividad', '=', 'actividades.id') // relacionamos el id de actividades con voluntariado actividades
            ->join('voluntario_personas', 'voluntario_actividades.idVoluntario_Persona', '=', 'voluntario_personas.id') //Voluntario Persona con Voluntario Actividad
            ->join('personas as perVoluntarias', 'voluntario_personas.identificacion', '=', 'perVoluntarias.id') //Personas con VOluntario Personas
            ->join('voluntario_estudiantes', 'voluntario_actividades.idVoluntario_Estudiante', '=', 'voluntario_estudiantes.id') //Estudiantes con Voluntario Actividades
            ->join('personas as perEstudiante', 'voluntario_estudiantes.identificacion', '=', 'perEstudiante.id') //Persona con Estudiante
            ->select('voluntario_actividades.*', 'perVoluntarias.nombre as NombrePersona', 'perVoluntarias.apellido1 as ApellidoPersona',
                'perEstudiante.nombre as NombreEstudiante', 'perEstudiante.apellido1 as ApellidoEstudiante',
                'actividades.id as ActId', 'actividades.nombre as ActNombre', 'actividades.cantParticipantes as ActCupos', 'voluntario_personas.identificacion as VolPerId',
                'voluntario_personas.identificacionPersona as VolPerCedula', 'voluntario_estudiantes.identificacion as volEstId',
                'voluntario_estudiantes.identificacionPersona as volEstCedula', 'voluntario_estudiantes.identificacionPersona as volEstCedula')
            ->paginate($filtro);

        return $this->sendResponse($voluntarioActi, 'Lista de Voluntario Actividades!');
    }

    function list() {
        $voluntarioActi = DB::table('voluntario_actividades')
            ->join('actividades', 'voluntario_actividades.idActividad', '=', 'actividades.id') // relacionamos el id de actividades con voluntariado actividades
            ->join('voluntario_personas', 'voluntario_actividades.idVoluntario_Persona', '=', 'voluntario_personas.id') //Voluntario Persona con Voluntario Actividad
            ->join('personas as perVoluntarias', 'voluntario_personas.identificacion', '=', 'perVoluntarias.id') //Personas con VOluntario Personas
            ->join('voluntario_estudiantes', 'voluntario_actividades.idVoluntario_Estudiante', '=', 'voluntario_estudiantes.id') //Estudiantes con Voluntario Actividades
            ->join('personas as perEstudiante', 'voluntario_estudiantes.identificacion', '=', 'perEstudiante.id') //Persona con Estudiante
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
            ->join('personas as perEstudiante', 'voluntario_estudiantes.identificacion', '=', 'perEstudiante.id') //Persona con Estudiante
            ->join('voluntarios', 'voluntario_estudiantes.voluntariado_id', '=', 'voluntarios.id') //Voluntario con Estudiante
            ->select('perEstudiante.*', 'voluntario_estudiantes.id as VolEstID', 'voluntario_estudiantes.voluntariado_id as voluntariadoID', 'voluntarios.cantidad as cantidadActividad')
            ->get();
        return $this->sendResponse($voluntarioActi, 'Lista de Voluntario Estudiantes!');
    }

    public function listarVoluntarioPersonas()
    {
        $voluntarioActi = DB::table('voluntario_personas')
            ->join('personas as perVoluntariados', 'voluntario_personas.identificacion', '=', 'perVoluntariados.id') //Persona con Voluntariado
            ->join('voluntarios', 'voluntario_personas.voluntariado_id', '=', 'voluntarios.id') //Voluntario con Persona
            ->select('perVoluntariados.*', 'voluntario_personas.id as VolPerID', 'voluntario_personas.voluntariado_id as voluntariadoID', 'voluntarios.cantidad as cantidadActividad')
            ->get();
        return $this->sendResponse($voluntarioActi, 'Lista de Personas Voluntariadas!');
    }

    public function ActualizarDatosActividad(Request $request)
    {
        try {
            //Metodo para actualizar los datos de la actividad
            $idActividadP = $request->idAct;
            $CuposNuevo = $request->Cupos;
            $voluntarioActi = DB::table('actividades')
                ->where('id', $idActividadP)
                ->update(['cantParticipantes' => $CuposNuevo]);
            //Metodo para cambiar la cantidad de actividades en persona
            $idVoluntarioPe = $request->idVoluntarioPer;
            $cantidadPer = $request->CantidadPer;
            $voluntarioActi = DB::table('voluntarios')
                ->where('id', $idVoluntarioPe)
                ->update(['cantidad' => $cantidadPer]);
            //metodo para cambiar la cantidad de actividades en estudiante
            $idVoluntarioEs = $request->idVoluntarioEst;
            $cantidadEst = $request->CantidadEst;

            $voluntarioActi = DB::table('voluntarios')
                ->where('id', $idVoluntarioEs)
                ->update(['cantidad' => $cantidadEst]);

        } catch (\Exception$e) {
            return $e->getMessage();
        }
        return $this->sendResponse($voluntarioActi, 'Datos Actualizados!');
    }

    public function ActualizarDatosActividadAnterior(Request $request)
    {
        try {
            //Metodo para actualizar los datos de la actividad
            $idActividadP = $request->idAct;
            $CuposNuevo = $request->Cupos;
            $voluntarioActi = DB::table('actividades')
                ->where('id', $idActividadP)
                ->update(['cantParticipantes' => $CuposNuevo]);
            //Metodo para cambiar la cantidad de actividades en persona
            $idVoluntarioPe = $request->idVoluntarioPer;
            $cantidadPer = $request->CantidadPer;
            $voluntarioActi = DB::table('voluntarios')
                ->where('id', $idVoluntarioPe)
                ->update(['cantidad' => $cantidadPer]);
            //metodo para cambiar la cantidad de actividades en estudiante
            $idVoluntarioEs = $request->idVoluntarioEst;
            $cantidadEst = $request->CantidadEst;

            $voluntarioActi = DB::table('voluntarios')
                ->where('id', $idVoluntarioEs)
                ->update(['cantidad' => $cantidadEst]);

        } catch (\Exception$e) {
            return $e->getMessage();
        }
        return $this->sendResponse($voluntarioActi, 'Datos Anterior Actualizados!');
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
