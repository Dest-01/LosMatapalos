<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\admin\ArticuloRequest;
use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends BaseController
{

    protected $Articulos = '';
    
    public function __construct(Articulo $Articulos)
    {
        $this->middleware('auth:api');
        $this->articulo = $Articulos;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Articulos = $this->articulo->latest()->paginate(10);
        return $this->sendResponse($Articulos, 'Articulos de la marca');
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
            'Name' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:30|min:3',
            'Type' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|string|max:30|min:3',
            'Image' => 'required|sometimes|base64image:png,jpeg,jpg',
        ];
    
        $messages = [
            'Name.max'=>'Minimo 3 caracteres',
            'Name.min'=>'Maximo 20 caracteres',
            'Name.*'=>'Digite el nombre del articulo',
            'Type.max'=>'Minimo 3 caracteres',
            'Type.min'=>'Maximo 20 caracteres',
            'Type.*' => 'Indique tipo de articulo a publicar',
            'Image.*' => 'Cargue una foto del Articulo',

        ];


        $this->validate($request, $rules, $messages);

        if($request->Image){
            $name = time().'.' . explode('/', explode(':', substr($request->Image, 0, strpos($request->Image, ';')))[1])[1];
            (!file_exists(public_path().'/images/Articulos/')) ? mkdir(public_path().'/images/Articulos/',0777,true) : null;
           \Image::make($request->Image)->save(public_path('images/Articulos/').$name);
           $request->merge(['Image' => $name]);

        }

        $tag = $this->articulo->create([

            'Name' => $request->get('Name'),
            'Type' => $request->get('Type'),
            'Image' => $request->get('Image')
            
        ]);
        return $this->sendResponse($tag, 'Articulo creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'Name' => 'required|min:3|max:20',
            'Type' => 'required|min:3|max:20',
        ];
    
        $messages = [
            'Name.max'=>'Minimo 3 caracteres',
            'Name.min'=>'Maximo 20 caracteres',
            'Name.*'=>'Digite el nombre del articulo',
            'Type.max'=>'Minimo 3 caracteres',
            'Type.min'=>'Maximo 20 caracteres',
            'Type.*' => 'Indique tipo de articulo a publicar',

        ];


        $this->validate($request, $rules, $messages);
        
        $tag = $this->articulo->findOrFail($id);

        $currentPhoto = $tag->Image;


        if($request->Image != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->Image, 0, strpos($request->Image, ';')))[1])[1];
            (!file_exists(public_path().'/images/Articulos/')) ? mkdir(public_path().'/images/Articulos/',0777,true) : null;
            \Image::make($request->Image)->save(public_path('images/Articulos/').$name);
            $request->merge(['Image' => $name]);

            $userPhoto = public_path('images/Articulos/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }

        }

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Articulo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $articulo = Articulo::FindOrFail($id);  
        if(file_exists('images/Articulos/'.$articulo->Image) AND !empty($articulo->Image)){ 
              unlink('images/Articulos/'.$articulo->Image);
           } 
              try{
  
                  $articulo->delete();
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
