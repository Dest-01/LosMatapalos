<?php

namespace App\Http\Controllers\API\V1;

use App\Models\ActividadesPasadas;
use Illuminate\Http\Request;

class ActividadesPasadasController extends BaseController
{
    protected $actividadesPasadas = '';
    public function __construct(ActividadesPasadas $actividadesPasadas)
    {
        $this->middleware('auth:api');
        $this->actividadesPasadas = $actividadesPasadas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividadesPasadas = $this->actividadesPasadas->latest()->paginate(10);
        return $this->sendResponse($actividadesPasadas, 'Lista imagenes de actividades pasadas!');
    }

    public function mostrar(Request $request)
    {
        $filtro = $request->valor;

        $actividadesPasadas = $this->actividadesPasadas->latest()->paginate($filtro);

        return $this->sendResponse($actividadesPasadas, 'Lista imagenes de actividades pasadas!');
    }

    public function list()
    {
        $actividadesPasadas = $this->actividadesPasadas->get();
        
        return $this->sendResponse($actividadesPasadas, 'Lista de todas las imagenes actividades pasadas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'nombre' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/|string|max:30|min:3',
                'fecha' => 'required|date|',
                'descripcion' => 'required|string|max:255|min:5',
                'imagen' => 'required|sometimes|base64image:png,jpeg,jpg',
    
            ];
        
            $messages = [
                'nombre.min' =>'Mínimo 3 caracteres',
                'nombre.max' => 'Máximo 30 caracteres',
                'nombre.*' => 'Escriba el nombre de la actividad de la imagen,  no puede estar vacio o llevar números',
                'descripcion.min' =>'Mínimo 5 caracteres',
                'descripcion.*' => 'Breve descripción de actividad realizada, debe tener al menos 3 caracteres y máximo 255',
                'imagen.*' => 'Cargue una foto',
                ];
    
    
            $this->validate($request, $rules, $messages);

            if ($request->imagen) {
                $name = time() . '.' . explode('/', explode(':', substr($request->imagen, 0, strpos ($request->imagen, ';')))[1])[1];
                (!file_exists(public_path().'/images/ActividadesPasadas/')) ? mkdir(public_path().'/images/ActividadesPasadas/',0777,true) : null;

                \Image::make($request->imagen)->save(public_path('images/ActividadesPasadas/') . $name);
                $request->merge(['imagen' => $name]);

            }

            $tag = $this->actividadesPasadas->create([
                'nombre' => $request->get('nombre'),
                'fecha' => $request->get('fecha'),
                'descripcion' => $request->get('descripcion'),
                'imagen' => $request->get('imagen'),
            ]);
            return $this->sendResponse($tag, 'Registro realizado!');
        } catch (\PDOException | Exception $e) {
            return response()->json(["errors" => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActividadesPasadas  $actividadesPasadas
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActividadesPasadas  $actividadesPasadas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = [
            'nombre' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/|string|max:30|min:3',
            'fecha' => 'required|date|after:2020-01-01',
            'descripcion' => 'required|string|max:255|min:5',

        ];
    
        $messages = [
            'nombre.min' =>'Mínimo 3 caracteres',
            'nombre.max' => 'Máximo 30 caracteres',
            'nombre.*' => 'Escriba el nombre de la actividad de la imagen,  no puede estar vacio o llevar números',
            'descripcion.min' =>'Mínimo 5 caracteres',
            'descripcion.*' => 'Breve descripción de actividad realizada, debe tener al menos 3 caracteres y máximo 255',
            'fecha.*' => 'requiere una fecha mayor al 2020-01-01',
            ];


        $this->validate($request, $rules, $messages);

        $tag = $this->actividadesPasadas->findOrFail($id);

        $currentPhoto = $tag->imagen;

        if ($request->imagen != $currentPhoto) {
            $name = time() . '.' . explode('/', explode(':', substr($request->imagen, 0, strpos($request->imagen, ';')))[1])[1];

            \Image::make($request->imagen)->save(public_path('images/ActividadesPasadas/') . $name);
            $request->merge(['imagen' => $name]);

            $userPhoto = public_path('images/ActividadesPasadas/') . $currentPhoto;
            if (file_exists($userPhoto)) {
                @unlink($userPhoto);
            }

        }

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Registro actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActividadesPasadas  $actividadesPasadas
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $actividadesPasadas = ActividadesPasadas::FindOrFail($id);
        if (file_exists('images/ActividadesPasadas/' . $actividadesPasadas->imagen) and !empty($actividadesPasadas->imagen)) {
            unlink('images/ActividadesPasadas/' . $actividadesPasadas->imagen);
        }
        try {

            $actividadesPasadas->delete();
            $bug = 0;
        } catch (\Exception$e) {
            $bug = $e->errorInfo[1];
        }
        if ($bug == 0) {
            echo "success";
        } else {
            echo 'error';
        }
    }
}
