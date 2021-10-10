<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Fauna;
use Illuminate\Http\Request;

class FaunaController extends BaseController
{

    protected $fauna = '';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Fauna $fauna)
    {
        $this->middleware('auth:api');
        $this->fauna = $fauna;
    }

    public function index()
    {
        $faunas = $this->fauna->latest()->paginate(10);
        return $this->sendResponse($faunas, 'Lista de fauna');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nombreComun' => 'required|string|max:20|min:3',
            'nombreCientifico' => 'required|string|max:50|min:3',
            'descripcion' => 'required|string|max:250|min:3',
            'tipo' => 'required|string|max:50|min:3',
            'imagen' => 'required',
            'familiaCientifca' => 'required|string|max:50|min:3',
            'fechaRegistro' => 'required',
        ];
    
        $messages = [
            'nombreComun.*' => 'Nombre comun requiere mínimo 3 caracteres y máximo 20',
            'nombreCientifico.*' => 'Nombre cientifico comun requiere mínimo 3 caracteres y máximo 50',
            'descripcion.*' => 'Descripcion requiere mínimo 3 caracteres y máximo 250',
            'tipo.*' => 'El tiporequiere mínimo 3 caracteres y máximo 50',
            'imagen.*' => 'Imagen se requiere',
            'familiaCientifca.*' => 'Familia cientifica requiere mínimo 3 caracteres y máximo 50',
            'fechaRegistro.*' => 'Tipo se requiere',
        ];


        $this->validate($request, $rules, $messages);
      

        if($request->imagen){
            $name = time().'.' . explode('/', explode(':', substr($request->imagen, 0, strpos
            ($request->imagen, ';')))[1])[1];
           \Image::make($request->imagen)->save(public_path('images/Fauna/').$name);
           $request->merge(['imagen' => $name]);
        }
        $tag = $this->fauna->create([
            'nombreComun' => $request->get('nombreComun'),
            'nombreCientifico' => $request->get('nombreCientifico'),
            'descripcion' => $request->get('descripcion'),
            'tipo' => $request->get('tipo'),
            'imagen' => $request->get('imagen'),
            'familiaCientifca' => $request->get('familiaCientifca'),
            'fechaRegistro' => $request->get('fechaRegistro'),
            
        ]);
        return $this->sendResponse($tag, 'Se registro con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fauna  $fauna
     * @return \Illuminate\Http\Response
     */
    public function show(Fauna $fauna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fauna  $fauna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nombreComun' => 'required|string|max:20|min:3',
            'nombreCientifico' => 'required|string|max:50|min:3',
            'descripcion' => 'required|string|max:250|min:3',
            'tipo' => 'required|string|max:50|min:3',
            'imagen' => 'required',
            'familiaCientifca' => 'required|string|max:50|min:3',
            'fechaRegistro' => 'required',
        ];
    
        $messages = [
            'nombreComun.*' => 'Nombre comun requiere mínimo 3 caracteres y máximo 20',
            'nombreCientifico.*' => 'Nombre cientifico comun requiere mínimo 3 caracteres y máximo 50',
            'descripcion.*' => 'Descripcion requiere mínimo 3 caracteres y máximo 250',
            'tipo.*' => 'El tiporequiere mínimo 3 caracteres y máximo 50',
            'imagen.*' => 'Imagen se requiere',
            'familiaCientifca.*' => 'Familia cientifica requiere mínimo 3 caracteres y máximo 50',
            'fechaRegistro.*' => 'Tipo se requiere',
        ];


        $this->validate($request, $rules, $messages);

        $tag = $this->fauna->findOrFail($id);
        $currentFoto = $tag->imagen;
        if($request->imagen != $currentFoto){
         $name = time().'.' . explode('/', explode(':', substr($request->imagen, 0, strpos
         ($request->imagen, ';')))[1])[1];
 
         \Image::make($request->imagen)->save(public_path('images/Fauna/').$name);
          $request->merge(['imagen' => $name]);
 
          $faunaFoto = public_path('images/Fauna/').$currentFoto;
          if(file_exists($faunaFoto)){
              @unlink($faunaFoto);
          }
        }
        $tag->update($request->all());
        return $this->sendResponse($tag, 'Informacion Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fauna  $fauna
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $fauna = Fauna::FindOrFail($id);
        if(file_exists('images/Fauna/'.$fauna->imagen) AND !empty($fauna->imagen)){
            unlink('images/Fauna/'.$fauna->imagen);
        }try{
            $fauna->delete();
            $bug = 0;
        }catch(\Exception $e){
            $bug = $e->errorInfo[1];
        }if($bug==0){
            echo "success";
        }else{
            echo 'error';
        }
    }
}
