<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Fauna;
use Illuminate\Http\Request;

class FaunaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $fauna = '';
    public function __construct(Fauna $fauna)
    {
        $this->middleware('auth:api');
        $this->fauna = $fauna;
    }
    public function index()
    {
        $fauna = $this->fauna->latest()->paginate(10);

        return $this->sendResponse($fauna, 'Lista de fauna');
    }

    public function list()
    {
        $fauna = $this->fauna->get();

        return $this->sendResponse($fauna, 'Lista de fauna');
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
                'nombreComun' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/|string|max:30|min:3',
                'nombreCientifico' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/|string|max:30|min:3',
                'descripcion' => 'required|string|max:255|min:5',
                'tipo' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/|string|max:30|min:3',
                'fechaRegistro' => 'required|date|after:2020-01-01',
                'familiaCientifca' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/|string|max:30|min:3',
    
            ];
        
            $messages = [
                'nombreComun.min' =>'Mínimo 3 caracteres',
                'nombreComun.max' => 'Máximo 30 caracteres',
                'nombreComun.*' => 'Escriba el nombre común de la especie,  no puede estar vacio o llevar números',
                'nombreCientifico.min' =>'Mínimo 3 caracteres',
                'nombreCientifico.max' => 'Máximo 30 caracteres',
                'nombreCientifico.*' => 'Escriba el nombre científico de la especie  no puede estar vacio o llevar números',
                'descripcion.min' =>'Mínimo 5 caracteres',
                'descripcion.*' => 'Breve descripción de la especie debe tener al menos 3 caracteres y máximo 255',
                'tipo.min' =>'Mínimo 15 caracteres',
                'tipo.max' => 'Máximo 30 caracteres',
                'tipo.*' => 'Nombre del tipo de especie no puede estar vacio o llevar números',
                'fechaRegistro.*' => 'requiere una fecha mayor al 2020-01-01',
                'imagen.*' => 'Cargue una foto',
                'familiaCientifca.min' =>'Mínimo 3 caracteres',
                'familiaCientifca.max' => 'Máximo 30 caracteres',
                'familiaCientifca.*' => 'Nombre de la familia científca',
            ];
    
    
            $this->validate($request, $rules, $messages);

            if ($request->imagen) {
                $name = time() . '.' . explode('/', explode(':', substr($request->imagen, 0, strpos ($request->imagen, ';')))[1])[1];
                (!file_exists(public_path().'/images/Fauna/')) ? mkdir(public_path().'/images/Fauna/',0777,true) : null;

                \Image::make($request->imagen)->save(public_path('images/Fauna/') . $name);
                $request->merge(['imagen' => $name]);

            }

            $tag = $this->fauna->create([
                'nombreComun' => $request->get('nombreComun'),
                'nombreCientifico' => $request->get('nombreCientifico'),
                'descripcion' => $request->get('descripcion'),
                'tipo' => $request->get('tipo'),
                'imagen' => $request->get('imagen'),
                'fechaRegistro' => $request->get('fechaRegistro'),
                'familiaCientifca' => $request->get('familiaCientifca'),

            ]);
            return $this->sendResponse($tag, 'datos registrados');
        } catch (\PDOException | Exception $e) {
            return response()->json(["errors" => $e->getMessage()], 500);
        }
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
            'nombreComun' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/|string|max:30|min:3',
            'nombreCientifico' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/|string|max:30|min:3',
            'descripcion' => 'required|string|max:255|min:5',
            'tipo' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/|string|max:30|min:3',
            'fechaRegistro' => 'required|date|after:2020-01-01',
            'imagen' => 'sometimes|base64image:png,jpeg,jpg',
            'familiaCientifca' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/|string|max:30|min:3',

        ];
    
        $messages = [
            'nombreComun.min' =>'Mínimo 3 caracteres',
            'nombreComun.max' => 'Máximo 30 caracteres',
            'nombreComun.*' => 'Escriba el nombre común de la especie,  no puede estar vacio o llevar números',
            'nombreCientifico.min' =>'Mínimo 3 caracteres',
            'nombreCientifico.max' => 'Máximo 30 caracteres',
            'nombreCientifico.*' => 'Escriba el nombre científico de la especie  no puede estar vacio o llevar números',
            'descripcion.min' =>'Mínimo 5 caracteres',
            'descripcion.*' => 'Breve descripción de la especie debe tener al menos 3 caracteres y máximo 255',
            'tipo.min' =>'Mínimo 15 caracteres',
            'tipo.max' => 'Máximo 30 caracteres',
            'tipo.*' => 'Nombre del tipo de especie no puede estar vacio o llevar números',
            'fechaRegistro.*' => 'requiere una fecha mayor al 2020-01-01',
            'imagen.*' => 'Cargue una foto',
            'familiaCientifca.min' =>'Mínimo 3 caracteres',
            'familiaCientifca.max' => 'Máximo 30 caracteres',
            'familiaCientifca.*' => 'Nombre de la familia científca',
        ];


        $this->validate($request, $rules, $messages);

        $tag = $this->fauna->findOrFail($id);

        $currentPhoto = $tag->imagen;

        if ($request->imagen != $currentPhoto) {
            $name = time() . '.' . explode('/', explode(':', substr($request->imagen, 0, strpos($request->imagen, ';')))[1])[1];

            \Image::make($request->imagen)->save(public_path('images/Fauna/') . $name);
            $request->merge(['imagen' => $name]);

            $userPhoto = public_path('images/Fauna/') . $currentPhoto;
            if (file_exists($userPhoto)) {
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

        $fauna = Fauna::FindOrFail($id);
        if (file_exists('images/Fauna/' . $fauna->imagen) and !empty($fauna->imagen)) {
            unlink('images/Fauna/' . $fauna->imagen);
        }
        try {

            $fauna->delete();
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
