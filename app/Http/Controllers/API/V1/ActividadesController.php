<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Actividades;
use App\Models\Voluntario;
use Illuminate\Http\Request;

class ActividadesController extends BaseController
{

    protected $actividades = '';
    protected $voluntario = '';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Actividades $actividades, Voluntario $voluntario)
    {
        $this->middleware('auth:api');
        $this->actividades = $actividades;
        $this->voluntario = $voluntario;
    }

    
    public function index()
    {
        $actividad = $this->actividades->latest()->paginate(10);
        return $this->sendResponse($actividad, 'Lista de Actividades!');
    }
    public function mostrar(Request $request)
    {
        $filtro = $request->valor;

        $actividad = $this->actividades->latest()->paginate($filtro);

        return $this->sendResponse($actividad, 'Lista de actividades!');
    }

    public function list()
    {
        $actividad = $this->actividades->get();
        return $this->sendResponse($actividad, 'Lista de Actividades!');
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
                'nombre' => 'required|string|max:150|min:3',
                'fecha' => 'required|after:today',
                'hora' => 'required',
                'descripcion' => 'required|string|max:255|min:3',
                'cantParticipantes' => 'required|integer|min:1|max:30',
                'imagen' => 'required|sometimes|base64image:png,jpeg,jpg',
                'tipo' => 'required',
            ];

            $messages = [
                'nombre.min' => 'Mínimo 3 caracteres',
                'nombre.max' => 'Máximo 150 caracteres',
                'nombre.*' => 'Nombre requiere',
                'fecha.*' => 'Seleccione 2 fechas después de hoy',
                'hora.*' => 'Seleccione un hora',
                'descripcion.min' => 'Mínimo 3 caracteres',
                'descripcion.max' => 'Máximo 255 caracteres',
                'descripcion.*' => 'Se requiere una breve descripción',
                'cantParticipantes.min' => 'Mínimo 1 participante',
                'cantParticipantes.max' => 'Máximo 30 participantes',
                'cantParticipantes.*' => 'Cantidad de participantes se requiere',
                'imagen.sometimes' => 'Solo imagenes, jpeg, jpg o png',
                'imagen.base64image' => 'Solo imagenes, jpeg, jpg o png',
                'imagen.*' => 'Cargue una imagen',
                'tipo.*' => 'Seleccione el tipo de actividad',
            ];

            $this->validate($request, $rules, $messages);

            if ($request->imagen) {
                $name = time() . '.' . explode('/', explode(':', substr($request->imagen, 0, strpos($request->imagen, ';')))[1])[1];
                (!file_exists(public_path().'/images/actividades/')) ? mkdir(public_path().'/images/actividades/',0777,true) : null;
                \Image::make($request->imagen)->save(public_path('images/actividades/') . $name);
                $request->merge(['imagen' => $name]);
            }
            $tag = $this->actividades->create([
                'nombre' => $request->get('nombre'),
                'fecha' => $request->get('fecha'),
                'hora' => $request->get('hora'),
                'descripcion' => $request->get('descripcion'),
                'cantParticipantes' => $request->get('cantParticipantes'),
                'imagen' => $request->get('imagen'),
                'tipo' => $request->get('tipo'),

            ]);
            return $this->sendResponse($tag, 'Actividad Creada!');
        } catch (\PDOException | Exception $e) {
            return response()->json(["errors" => $e->getMessage()], 500);
        }
    }

    public function obtenerVoluntarios()
    {
        $voluntario = Voluntario::get();
        /*foreach($voluntario as $key => $value):
        $voluntario[$key]->id = Voluntario::find($value->id,['id','nombre']);
        endforeach;*/

        return $voluntario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function show(Actividades $actividades)
    {
        //
    }

    public function actualizarparticipantes(Request $request, $id)
    {

        $rules = [
            'nombre' => 'required|string|max:150|min:3',
            'fecha' => 'required',
            'hora' => 'required',
            'descripcion' => 'required|string|max:255|min:3',
            'cantParticipantes' => 'required|integer|min:1|max:30',
            'tipo' => 'required',
        ];

        $messages = [
            'nombre.min' => 'Mínimo 3 caracteres',
            'nombre.max' => 'Máximo 150 caracteres',
            'nombre.*' => 'Nombre requiere',
            'fecha.*' => 'Fecha se requiere',
            'hora.*' => 'Seleccione un hora',
            'descripcion.min' => 'Mínimo 3 caracteres',
            'descripcion.max' => 'Máximo 255 caracteres',
            'descripcion.*' => 'Se requiere una breve descripción',
            'cantParticipantes.min' => 'Mínimo 1 participante',
            'cantParticipantes.max' => 'Máximo 30 participantes',
            'cantParticipantes.*' => 'Cantidad de participantes se requiere',
            'tipo.*' => 'Seleccione el tipo de actividad',
        ];

        $this->validate($request, $rules, $messages);

        $tag = $this->actividades->findOrFail($id);
        $currentFoto = $tag->imagen;
        if ($request->imagen != $currentFoto) {
            $name = time() . '.' . explode('/', explode(':', substr($request->imagen, 0, strpos
                ($request->imagen, ';')))[1])[1];

            \Image::make($request->imagen)->save(public_path('images/actividades/') . $name);
            $request->merge(['imagen' => $name]);

            $actividadFoto = public_path('images/actividades/') . $currentFoto;
            if (file_exists($actividadFoto)) {
                @unlink($actividadFoto);
            }
        }
        $tag->update($request->all());
        return $this->sendResponse($tag, 'Actividad Actualizada!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'nombre' => 'required|string|max:150|min:3',
            'fecha' => 'required|after:today',
            'hora' => 'required',
            'descripcion' => 'required|string|max:255|min:3',
            'cantParticipantes' => 'required|integer|min:1|max:30',
            'tipo' => 'required',
        ];

        $messages = [
            'nombre.min' => 'Mínimo 3 caracteres',
            'nombre.max' => 'Máximo 150 caracteres',
            'nombre.*' => 'Nombre requiere',
            'fecha.*' => 'Seleccione 2 fechas después de hoy',
            'hora.*' => 'Seleccione un hora',
            'descripcion.min' => 'Mínimo 3 caracteres',
            'descripcion.max' => 'Máximo 255 caracteres',
            'descripcion.*' => 'Se requiere una breve descripción',
            'cantParticipantes.min' => 'Mínimo 1 participante',
            'cantParticipantes.max' => 'Máximo 30 participantes',
            'cantParticipantes.*' => 'Cantidad de participantes se requiere',
            'tipo.*' => 'Seleccione el tipo de actividad',
        ];

        $this->validate($request, $rules, $messages);

        $tag = $this->actividades->findOrFail($id);
        $currentFoto = $tag->imagen;
        if ($request->imagen != $currentFoto) {
            $name = time() . '.' . explode('/', explode(':', substr($request->imagen, 0, strpos
                ($request->imagen, ';')))[1])[1];

            \Image::make($request->imagen)->save(public_path('images/actividades/') . $name);
            $request->merge(['imagen' => $name]);

            $actividadFoto = public_path('images/actividades/') . $currentFoto;
            if (file_exists($actividadFoto)) {
                @unlink($actividadFoto);
            }
        }
        $tag->update($request->all());
        return $this->sendResponse($tag, 'Actividad Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {

        $actividades = Actividades::FindOrFail($id);
        if (file_exists('images/actividades/' . $actividades->imagen) and !empty($actividades->imagen)) {
            unlink('images/actividades/' . $actividades->imagen);
        }try {
            $actividades->delete();
            $bug = 0;
        } catch (\Exception$e) {
            $bug = $e->errorInfo[1];
        }if ($bug == 0) {
            echo "success";
        } else {
            echo 'error';
        }
    }
}
