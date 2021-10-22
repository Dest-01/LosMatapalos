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
                'nombreComun' => 'required|string|min:3|max:30',
                'nombreCientifico' => 'required|string|min:3|max:30',
                'descripcion' => 'required|string|max:255|min:3',
                'tipo' => 'required|string|max:50|min:3',
                'fechaRegistro' => 'required|date',
                'imagen' => 'required',
                'familiaCientifca' => 'required|string|min:3|max:30',
    
            ];
        
            $messages = [
                'nombreComun.min' =>'Minimo 3 caracteres',
                'nombreComun.max' => 'Maximo 30 caracteres',
                'nombreComun.*' => 'Escriba el nombre común de la especie',
                'nombreCientifico.min' =>'Minimo 3 caracteres',
                'nombreCientifico.max' => 'Maximo 30 caracteres',
                'nombreCientifico.*' => 'Escriba el nombre científico de la especie',
                'descripcion.min' =>'Minimo 3 caracteres',
                'descripcion.*' => 'Breve descripción de la especie',
                'tipo.min' =>'Minimo 3 caracteres',
                'tipo.max' => 'Maximo 30 caracteres',
                'tipo.*' => 'Nombre del tipo de especie',
                'fechaRegistro.*' => 'Seleccione fecha de registro',
                'imagen.*' => 'Cargue una foto',
                'familiaCientifca.min' =>'Minimo 3 caracteres',
                'familiaCientifca.max' => 'Maximo 30 caracteres',
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
            'nombreComun' => 'required|string|min:3|max:30',
            'nombreCientifico' => 'required|string|min:3|max:30',
            'descripcion' => 'required|string|max:255|min:3',
            'tipo' => 'required|string|max:50|min:3',
            'fechaRegistro' => 'required|date',
            'imagen' => 'required',
            'familiaCientifca' => 'required|string|min:3|max:30',

        ];
    
        $messages = [
            'nombreComun.min' =>'Minimo 3 caracteres',
            'nombreComun.max' => 'Maximo 30 caracteres',
            'nombreComun.*' => 'Escriba el nombre común de la especie',
            'nombreCientifico.min' =>'Minimo 3 caracteres',
            'nombreCientifico.max' => 'Maximo 30 caracteres',
            'nombreCientifico.*' => 'Escriba el nombre científico de la especie',
            'descripcion.min' =>'Minimo 3 caracteres',
            'descripcion.*' => 'Breve descripción de la especie',
            'tipo.min' =>'Minimo 3 caracteres',
            'tipo.max' => 'Maximo 30 caracteres',
            'tipo.*' => 'Nombre del tipo de especie',
            'fechaRegistro.*' => 'Seleccione fecha de registro',
            'imagen.*' => 'Cargue una foto',
            'familiaCientifca.min' =>'Minimo 3 caracteres',
            'familiaCientifca.max' => 'Maximo 30 caracteres',
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
