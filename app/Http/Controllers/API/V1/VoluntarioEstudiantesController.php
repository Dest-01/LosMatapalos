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
        if($request->imagen){
            $name = time().'.' . explode('/', explode(':', substr($request->imagen, 0, strpos
            ($request->imagen, ';')))[1])[1];
           \Image::make($request->imagen)->save(public_path('images/voluntariado/').$name);
           $request->merge(['imagen' => $name]);
        }
        $tag = $this->voluntarioEstudiantes->create([
            'identificacion' => $request->get('identificacion'),
            'voluntariado_id' => $request->get('voluntariado_id'),
            'carrera' => $request->get('carrera'),
            'imagen' => $request->get('imagen')
            
        ]);
        return $this->sendResponse($tag, 'Voluntario estudiantes creado');
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
        {
            $tag = $this->voluntarioEstudiantes->findOrFail($id);
            $currentFoto = $tag->imagen;
            if($request->imagen != $currentFoto){
             $name = time().'.' . explode('/', explode(':', substr($request->imagen, 0, strpos
             ($request->imagen, ';')))[1])[1];
     
             \Image::make($request->imagen)->save(public_path('images/voluntariado/').$name);
              $request->merge(['imagen' => $name]);
     
              $EstudianteFoto = public_path('images/voluntariado/').$currentFoto;
              if(file_exists($EstudianteFoto)){
                  @unlink($EstudianteFoto);
              }
            }
            $tag->update($request->all());
            return $this->sendResponse($tag, 'Voluntariado Actualizada');
        }
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

        if(file_exists('images/voluntariado/'.$voluntarioEst->photo) AND !empty($voluntarioEst->photo)){ 
            unlink('images/voluntariado/'.$voluntarioEst->photo);
         } 
            try{

                $voluntarioEst->delete();
                $bug = 0;
            }
            catch(\Exception $e){
                $bug = $e->errorInfo[1];
            } 
            if($bug==0){
                echo "success";
                return $this->sendResponse($voluntarioEst, 'Voluntario Estudiante eliminado');
            }else{
                echo 'error';
            }

       
    }
}
