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
        return $this->sendResponse($Articulos, 'Lista 10');
    }
    public function list()
    {
        $Articulos = $this->articulo->get();
        return $this->sendResponse($Articulos, 'Lista todo');
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
            'Nombre' => 'required|string|min:3|max:100|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'Tipo' => 'required|string|min:3|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'Image' => 'required|sometimes|base64image:png,jpeg,jpg',
            'Descripcion' => 'required|string|max:255|min:5',

        ];
    
        $messages = [
            'Nombre.max'=>'Minimo 3 caracteres',
            'Nombre.min'=>'Maximo 100 caracteres',
            'Nombre.*'=>'Digite el nombre del articulo',
            'Tipo.max'=>'Minimo 3 caracteres',
            'Tipo.min'=>'Maximo 50 caracteres',
            'Tipo.*' => 'Indique tipo de articulo a publicar',
            'Image.*' => 'Cargue una foto del Articulo',
            'descripcion.min' =>'Mínimo 5 caracteres',
            'descripcion.*' => 'Breve descripción de la especie debe tener al menos 3 caracteres y maximo 255',

        ];


        $this->validate($request, $rules, $messages);

        if($request->Image){
            $name = time().'.' . explode('/', explode(':', substr($request->Image, 0, strpos($request->Image, ';')))[1])[1];
            (!file_exists(public_path().'/images/Articulos/')) ? mkdir(public_path().'/images/Articulos/',0777,true) : null;
           \Image::make($request->Image)->save(public_path('images/Articulos/').$name);
           $request->merge(['Image' => $name]);

        }

        $tag = $this->articulo->create([

            'Nombre' => $request->get('Nombre'),
            'Tipo' => $request->get('Tipo'),
            'Image' => $request->get('Image'),
            'Descripcion' => $request->get('Descripcion'),
            
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
            'Nombre' => 'required|string|min:3|max:100|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'Tipo' => 'required|string|min:3|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'Descripcion' => 'required|string|max:255|min:5',

        ];
    
        $messages = [
            'Nombre.max'=>'Minimo 3 caracteres',
            'Nombre.min'=>'Maximo 100 caracteres',
            'Nombre.*'=>'Digite el nombre del articulo',
            'Tipo.max'=>'Minimo 3 caracteres',
            'Tipo.min'=>'Maximo 50 caracteres',
            'Tipo.*' => 'Indique tipo de articulo a publicar',
            'descripcion.min' =>'Mínimo 5 caracteres',
            'descripcion.*' => 'Breve descripción de la especie debe tener al menos 3 caracteres y maximo 255',

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
