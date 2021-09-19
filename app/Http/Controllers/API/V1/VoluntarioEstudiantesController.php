<?php

namespace App\Http\Controllers\API\V1;

use App\Models\VoluntarioEstudiantes;
use Illuminate\Http\Request;
use App\Http\Requests\admin\VoluntarioEstudiantesRequest;
use App\Models\Personas;
use App\Models\Voluntario;

class VoluntarioEstudiantesController extends BaseController
{

    protected $personas = '';
    protected $voluntarios = '';
    protected $voluntarioEstudiantes = '';

    public function __construct(VoluntarioEstudiantes $voluntarioEstudiantes, Personas $personas, Voluntario $voluntarios)
    {
        $this->middleware('auth:api');
        $this->voluntarioEstudiantes = $voluntarioEstudiantes;
        $this->personas = $personas;
        $this->voluntarios = $voluntarios;
    }

    public function obtenerCedula(Request $request)
    {
        $filtro = $request->buscadorC;
        $persona = Personas::where('id', $filtro)->get('id');
            return $this->sendResponse($persona, 'Cedula si existe');
        
       
    }

    public function obtenerNombreVoluntario(Request $request)
    {
        $filtro = $request->buscadorV;
        $voluntario = Voluntario::where('nombre', $filtro)->get();
            return $this->sendResponse($voluntario, 'Voluntario si existe');
        
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voluntarioEst = $this->voluntarioEstudiantes->latest()->paginate(10);

        return $this->sendResponse($voluntarioEst, 'Lista de estudiantes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoluntarioEstudiantesRequest $request)
    {
        $tag = $this->voluntarioEstudiantes->create([
            'identificacion' => $request->get('identificacion'),
            'voluntariado_id' => $request->get('voluntariado_id'),
            'Universidad' => $request->get('Universidad'),
            'carrera' => $request->get('carrera'),
        ]);

        return $this->sendResponse($tag, 'Voluntario estudiante creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoluntarioEstudiantes  $voluntarioEstudiantes
     * @return \Illuminate\Http\Response
     */
    public function show(VoluntarioEstudiantes $voluntarioEstudiantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VoluntarioEstudiantes  $voluntarioEstudiantes
     * @return \Illuminate\Http\Response
     */
    public function update(VoluntarioEstudiantesRequest $request, $id)
    {
        $tag = $this->voluntarioEstudiantes->findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Voluntario Estudiante Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoluntarioEstudiantes  $voluntarioEstudiantes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $voluntarioEst = $this->voluntarioEstudiantes->findOrFail($id);

        $voluntarioEst->delete();

        return $this->sendResponse($voluntarioEst, 'Voluntario Estudiante eliminado');
    }
}
