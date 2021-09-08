<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Test\DonativosRequest;
use App\Models\Donativos;
use Illuminate\Http\Request;

class DonativosController extends BaseController
{

    public function __construct(Donativos $donativos)
    {
        $this->middleware('auth:api');
        $this->donativos = $donativos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donativo = $this->donativos->latest()->paginate(10);

        return $this->sendResponse($donativo, 'Lista Donativos');
    }


    public function list()
    {
        $donativo = $this->donativos->pluck('tipo', 'id');

        return $this->sendResponse($donativo, 'Lista Donativos');
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
            
           \Image::make($request->photo)->save(public_path('images/donativos/').$name);
           $request->merge(['photo' => $name]);

        }

        $tag = $this->donativos->create([
            'tipo' => $request->get('tipo'),
            'detalle' => $request->get('detalle'),
            'photo' => $request->get('photo'),
            'fecha' => $request->get('fecha'),
            'estado' => $request->get('estado')
        ]);
        return $this->sendResponse($tag, 'Donativo creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donativos  $donativos
     * @return \Illuminate\Http\Response
     */
    public function show(Donativos $donativos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donativos  $donativos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = $this->donativos->findOrFail($id);

        $currentPhoto = $tag->photo;


        if($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('images/donativos/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('images/donativos/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }

        }

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Donativo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donativos  $donativos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $donativos = Donativos::FindOrFail($id);  
        if(file_exists('images/donativos/'.$donativos->photo) AND !empty($donativos->photo)){ 
              unlink('images/donativos/'.$donativos->photo);
           } 
              try{
  
                  $donativos->delete();
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
