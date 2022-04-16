<?php

namespace App\Http\Controllers\API\Reportes;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteVoluntarioActividadController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtro(Request $request)
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

        return $this->sendResponse($voluntarioActi, 'Registro Filtrado');
    }

    
    public function todo()
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
            ->get();

        return $this->sendResponse($voluntarioActi, 'Todo Registro');
    }






}
