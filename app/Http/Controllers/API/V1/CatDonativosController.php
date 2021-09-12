<?php

namespace App\Http\Controllers\API\V1;

use App\Models\CatDonativos;
use Illuminate\Http\Request;

class CatDonativosController extends BaseController
{
    protected $catDonativos = '';
    
    public function __construct(CatDonativos $catDonativos)
    {
        $this->middleware('auth:api');
        $this->catDonativos = $catDonativos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catDonativo = $this->catDonativos->latest()->paginate(10);

        return $this->sendResponse($catDonativo, 'Categoria de donativos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->photo){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
            
           \Image::make($request->photo)->save(public_path('images/CatDonativos/').$name);
           $request->merge(['photo' => $name]);

        }

        $tag = $this->catDonativos->create([
            'nombre' => $request->get('nombre'),
            'estado' => $request->get('estado'),
            'photo' => $request->get('photo')
            
        ]);
        return $this->sendResponse($tag, 'Categoria donativo creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatDonativos  $catDonativos
     * @return \Illuminate\Http\Response
     */
    public function show(CatDonativos $catDonativos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CatDonativos  $catDonativos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = $this->catDonativos->findOrFail($id);

        $currentPhoto = $tag->photo;


        if($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('images/CatDonativos/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('images/CatDonativos/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }

        }

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Categoria Donativo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatDonativos  $catDonativos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $catDonativos = CatDonativos::FindOrFail($id);  
        if(file_exists('images/CatDonativos/'.$catDonativos->photo) AND !empty($catDonativos->photo)){ 
              unlink('images/CatDonativos/'.$catDonativos->photo);
           } 
              try{
  
                  $catDonativos->delete();
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
