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
            'nom_comun' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/|string|max:30|min:3',
            'nom_cientifico' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/|string|max:30|min:3',
            'descripcion' => 'required|string|max:255|min:5',
            'tipo' => 'required|string|max:50',
            'photo' => 'required|sometimes|base64image:png,jpeg,jpg',
            'fecha_registro' => 'required|date|after:2020-01-01',
            'fam_cientifica' =>'required|regex:/^[a-zA-z09-9-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',

        ];
    
        $messages = [
            'nom_comun.min' =>'Mínimo  3 caracteres y máximo 30',
            'nom_comun.max' => 'Maximo 30 caracteres',
            'nom_comun.*' => 'Escriba el nombre común de la especie',
            'nom_cientifico.min' =>'Mínimo 3 caracteres',
            'nom_cientifico.max' => 'Máximo 30 caracteres',
            'nom_cientifico.*' => 'Escriba el nombre científico de la especie',
            'descripcion.min' =>'Mínimo 5 caracteres ',
            'descripcion.*' => 'Breve descripción de la especie',
            'tipo.*' => 'Seleccione un tipo de flora',
            'fechaRegistro.after' => 'requiere una fecha mayor al 2020-01-01',
            'fechaRegistro.*' => 'requiere una fecha mayor al 2020-01-01',
            'photo.*' => 'Cargue una foto',
            'fam_cientifica.min' =>'Mínimo 3 caracteres',
            'fam_cientifica.max' => 'Máximo 30 caracteres',
            'fam_cientifica.*' => 'Nombre de la familia científca',
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
        return $this->sendResponse($tag, 'datos registrados!');
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
            'nom_comun' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/|string|max:30|min:3',
            'nom_cientifico' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/|string|max:30|min:3',
            'descripcion' => 'required|string|max:255|min:5',
            'tipo' => 'required|string|max:50',
            'fecha_registro' => 'required|date|after:2020-01-01',
            'fam_cientifica' =>'required|regex:/^[a-zA-z09-9-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:20|min:3',

        ];
    
        $messages = [
            'nom_comun.min' =>'Mínimo  3 caracteres y máximo 30',
            'nom_comun.max' => 'Maximo 30 caracteres',
            'nom_comun.*' => 'Escriba el nombre común de la especie',
            'nom_cientifico.min' =>'Mínimo 3 caracteres',
            'nom_cientifico.max' => 'Máximo 30 caracteres',
            'nom_cientifico.*' => 'Escriba el nombre científico de la especie',
            'descripcion.min' =>'Mínimo 5 caracteres ',
            'descripcion.*' => 'Breve descripción de la especie',
            'tipo.*' => 'Seleccione un tipo de flora',
            'fechaRegistro.after' => 'requiere una fecha mayor al 2020-01-01',
            'fechaRegistro.*' => 'requiere una fecha mayor al 2020-01-01',
            'photo.*' => 'Cargue una foto',
            'fam_cientifica.min' =>'Mínimo 3 caracteres',
            'fam_cientifica.max' => 'Máximo 30 caracteres',
            'fam_cientifica.*' => 'Nombre de la familia científca',
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

        return $this->sendResponse($tag, 'Datos Actualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flora  $flora
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       

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