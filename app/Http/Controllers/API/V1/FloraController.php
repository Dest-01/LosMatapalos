<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Flora;
use Illuminate\Http\Request;

class FloraController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $flora = '';
    public function __construct(Flora $flora)
    {
        $this->middleware('auth:api');
        $this->flora = $flora;
    }
    public function index()
    {
        $flora = $this->flora->latest()->paginate(10);

        return $this->sendResponse($flora, 'Lista flora');
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
            'nom_comun' => 'required|string|',
            'nom_cientifico' => 'required|string|',
            'descripcion' => 'required|string|max:255',
            'tipo' => 'required|string|max:50',
            'fecha_registro' => 'required|date',
            'photo' => 'required',
            'fam_cientifica' => 'required|string|',

        ];
    
        $messages = [
            'nom_comun' => 'Escriba el nombre comun de la especie',
            'nom_cientifico' => 'Escriba el nombre cientifico de la especie',
            'descripcion.*' => 'Breve descripción de la especie',
            'tipo.*' => 'Seleccione un tipo de flora',
            'fecha_registro.*' => 'Seleccione fecha de registro',
            'photo.*' => 'Cargue una foto',
            'fam_cientifica.*' => 'Seleccione un la familia cientifica de la especie',
        ];


        $this->validate($request, $rules, $messages);

        if($request->photo){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
            
           \Image::make($request->photo)->save(public_path('images/flora/').$name);
           $request->merge(['photo' => $name]);

        }

        $tag = $this->flora->create([
            'nom_comun' => $request->get('nom_comun'),
            'nom_cientifico' => $request->get('nom_cientifico'),
            'descripcion' => $request->get('descripcion'),
            'tipo' => $request->get('tipo'),
            'photo' => $request->get('photo'),
            'fecha_registro' => $request->get('fecha_registro'),
            'fam_cientifica' => $request->get('fam_cientifica')
            
        ]);
        return $this->sendResponse($tag, 'datos registrados');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flora  $flora
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flora  $flora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nom_comun' => 'required|string|',
            'nom_cientifico' => 'required|string|',
            'descripcion' => 'required|string|max:255',
            'tipo' => 'required|string|max:50',
            'fecha_registro' => 'required|date',
            'photo' => 'required',
            'fam_cientifica' => 'required|string|',

        ];
    
        $messages = [
            'nom_comun' => 'Escriba el nombre comun de la especie',
            'nom_cientifico' => 'Escriba el nombre cientifico de la especie',
            'descripcion.*' => 'Breve descripción de la especie',
            'tipo.*' => 'Seleccione un tipo de flora',
            'fecha_registro.*' => 'Seleccione fecha de registro',
            'photo.*' => 'Cargue una foto',
            'fam_cientifica.*' => 'Seleccione un la familia cientifica de la especie',
        ];

        $this->validate($request, $rules, $messages);

        $tag = $this->flora->findOrFail($id);

        $currentPhoto = $tag->photo;


        if($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('images/flora/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('images/flora/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }

        }

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Datos Actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flora  $flora
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $flora = Flora::FindOrFail($id);  
        if(file_exists('images/flora/'.$flora->photo) AND !empty($flora->photo)){ 
              unlink('images/flora/'.$flora->photo);
           } 
              try{
  
                  $flora->delete();
                  $bug = 0;
              }
              catch(\Exception $e){
                  $bug = $e->errorInfo[1];
              } 
              if($bug==0){
                  echo "success";
              }else{
                  echo 'error';
              }
    
    }
}
