<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\admin\DonativosRequest;
use App\Models\Donativos;
use Illuminate\Http\Request;
use App\Models\Personas;
use App\Models\Organizaciones;

class DonativosController extends BaseController
{
    protected $personas = '';
    protected $organizaciones = '';
    protected $donativos = '';

    public function __construct(Donativos $donativos, Personas $personas, Organizaciones $organizaciones)
    {
        $this->middleware('auth:api');
        $this->donativos = $donativos;
        $this->personas = $personas;
        $this->organizaciones = $organizaciones;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donativo = $this->donativos->latest()->with('personas', 'organizaciones')->paginate(10);
      //  $products = $this->product->latest()->with('category', 'tags')->paginate(10);

        return $this->sendResponse($donativo, 'Lista Donativos');
    }


    public function list()
    {
//
    }

    public function obtenerCedula(Request $request)
    {
        $filtro = $request->buscador;
        $persona = Personas::where('id', $filtro)->get('id');
            return $this->sendResponse($persona, 'Cedula si existe');
        
       
    }
    public function obtenerCedulaOrg(Request $request)
    {
        $filtro = $request->buscador;
        $organizacion = Organizaciones::where('id', $filtro)->get('id');
        return $this->sendResponse($organizacion, 'Cedula si existe');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonativosRequest $request)
    {
        if($request->photo){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
            
           \Image::make($request->photo)->save(public_path('images/donativos/').$name);
           $request->merge(['photo' => $name]);

        }

        $tag = $this->donativos->create([
            'tipo' => $request->get('tipo'),
            'idPersona' => $request->get('idPersona'),
            'idOrganizacion' => $request->get('idOrganizacion'),
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
    public function show($id)
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
    public function update(DonativosRequest $request, $id)
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
