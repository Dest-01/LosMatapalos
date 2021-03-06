<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Admin\PersonasRequest;
use App\Models\Personas;
use App\Models\Voluntario;
use App\Models\VoluntarioEstudiantes;
use Illuminate\Http\Request;

class VoluntarioEstudiantesController extends BaseController
{

    protected $personas = '';
    protected $voluntarios = '';
    protected $voluntarioEstudiantes = '';

    public function __construct(VoluntarioEstudiantes $voluntarioEstudiantes, Personas $personas, Voluntario $voluntarios)
    {
        $this->middleware('auth:api');
        $this->voluntarioEstudiantes = $voluntarioEstudiantes;
        $this->personas = $personas;
        $this->voluntarios = $voluntarios;
    }

    public function consultarCedula(Request $request)
    {
        try {
            $filtro = $request->buscador;
            $existencia = Personas::where('identificacion', '=', $filtro)->first();
            if ($existencia !== null) {
                return response()->json(['success' => true, 'message' => 'Identifación si existe!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Identifación no existe!']);
            }

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

    public function obtenerCedula(Request $request)
    {
        try {
            $filtro = $request->buscador;
            $persona = Personas::where('identificacion', $filtro)->select('id','identificacion','correo')->get();
            return $this->sendResponse($persona, 'Identifación si existe!');

        } catch (\Exception$e) {
            return $e->getMessage();
        }

    }

    public function obtenerCantidad(Request $request)
    {
        $filtro = $request->VolCantidad;
        $cantidad = Voluntario::where('id', $filtro)->get();
        return $this->sendResponse($cantidad, 'Se encontro el id si existe!');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voluntarioEst = $this->voluntarioEstudiantes->latest()->paginate(25);

        return $this->sendResponse($voluntarioEst, 'Lista de estudiantes!');
    }

    public function mostrar()
    {
        $filtro = $request->valor;

        $voluntarioEst = $this->voluntarioEstudiantes->latest()->paginate($filtro);

        return $this->sendResponse($voluntarioEst, 'Lista de estudiantes!');
    }

    public function list()
    {
        $voluntarioEst = $this->voluntarioEstudiantes->get();

        return $this->sendResponse($voluntarioEst, 'Lista de todos los estudiantes!');
    }

    public function guardarPersona(PersonasRequest $request)
    {
        try {
            $filtro = $request->identificacion;
            $existencia = Personas::where('identificacion', '=', $filtro)->first();
            if ($existencia === null) {
                $tag = $this->personas->create([
                    'identificacion' => $request->get('identificacion'),
                    'nombre' => $request->get('nombre'),
                    'apellido1' => $request->get('apellido1'),
                    'apellido2' => $request->get('apellido2'),
                    'telefono' => $request->get('telefono'),
                    'correo' => $request->get('correo'),
                ]);

                return $this->sendResponse($tag, 'Persona registrada!');
            } else {
                return response()->json(['success' => false, 'message' => 'Identificación ya existe!']);
            }

        } catch (\Exception$e) {
            return $e->getMessage();
        }
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
            
            'carrera' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\s]+$/|string|max:50|min:3',
            'imagen' => 'required|sometimes|base64image:png,jpeg,jpg',
            'idVoluntario' => 'required|integer|min:1|max:9999',
            'cantidad'=> 'required|integer|min:0|max:999|',
        ];

        $messages = [
            'carrera.*' => 'Se requiere la carrera del estudiante',
            'carrera.min' => 'Mínimo 0 caracteres',
            'carrera.max' => 'Máximo 999 caracteres',
            'imagen.*' => 'Se requiere la foto del estudiante',
            'idVoluntario' => 'Mínimo 1 Id de voluntario',
            'idVoluntario.*' => 'Se requiere un Id de voluntario',
            'cantidad.*' => 'Se requiere una cantidad',
            'cantidad.*' => 'Se requiere una cantidad de actividades',
        ];
        $this->validate($request, $rules, $messages);
        if ($request->imagen) {
            $name = time() . '.' . explode('/', explode(':', substr($request->imagen, 0, strpos($request->imagen, ';')))[1])[1];
            (!file_exists(public_path() . '/images/voluntariado/')) ? mkdir(public_path() . '/images/voluntariado/', 0777, true) : null;

            \Image::make($request->imagen)->save(public_path('images/voluntariado/') . $name);
            $request->merge(['imagen' => $name]);

        }

        try {
            $filtro = $request->idVoluntario;
            $filtro2 = $request->IdentificacionEst;
            $existencia = Voluntario::where('id', '=', $filtro)->first();
            $existencia2 = VoluntarioEstudiantes::where('identificacionPersona', '=', $filtro2)->first();

            if ($existencia === null && $existencia2 === null) {
                $tag = $this->voluntarios->create([
                    'id' => $request->get('idVoluntario'),
                    'cantidad' => $request->get('cantidad'),
                ]);
                $tag = $this->voluntarioEstudiantes->create([
                    'identificacion' => $request->get('identificacion'),
                    'identificacionPersona' => $request->get('identificacionPersona'),
                    'voluntariado_id' => $request->get('voluntariado_id'),
                    'carrera' => $request->get('carrera'),
                    'imagen' => $request->get('imagen'),
                ]);
                return $this->sendResponse($tag, 'Voluntario estudiante registrado!');
            } else {
                return response()->json(['success' => false, 'message' => 'El voluntario ya existe!']);
            }

        } catch (\Exception$e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoluntarioEstudiantes  $voluntarioEstudiantes
     * @return \Illuminate\Http\Response
     */
    public function show(VoluntarioEstudiantes $voluntarioEstudiantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VoluntarioEstudiantes  $voluntarioEstudiantes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        $rules = [
            'carrera' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\s]+$/|string|max:30|min:3',
            'cantidad'=> 'required|integer|min:0|max:999|regex:/[0-9]{1,30}/',
        ];

        $messages = [
            'carrera.*' => 'Se requiere la carrera del Estudiante',
            'carrera.min' => 'Mínimo 0 caracteres',
            'carrera.max' => 'Maximo 999 caracteres',
            'cantidad.min' => 'Mínimo 1 actividad',
            'cantidad.max' => 'Maximo 30 actividades',
            'cantidad.*' => 'Se requiere una cantidad de actividades',
        ];

        $this->validate($request, $rules, $messages);

        $tag = $this->voluntarioEstudiantes->findOrFail($id);

        $currentPhoto = $tag->imagen;

        if ($request->imagen != $currentPhoto) {
            $name = time() . '.' . explode('/', explode(':', substr($request->imagen, 0, strpos($request->imagen, ';')))[1])[1];

            \Image::make($request->imagen)->save(public_path('images/voluntariado/') . $name);
            $request->merge(['imagen' => $name]);

            $userPhoto = public_path('images/voluntariado/') . $currentPhoto;
            if (file_exists($userPhoto)) {
                @unlink($userPhoto);
            }

        }

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Voluntariado estudiante actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoluntarioEstudiantes  $voluntarioEstudiantes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $voluntarioEst = $this->voluntarioEstudiantes->findOrFail($id);

        if (file_exists('images/voluntariado/' . $voluntarioEst->imagen) and !empty($voluntarioEst->imagen)) {
            unlink('images/voluntariado/' . $voluntarioEst->imagen);
        }
        try {

            $voluntarioEst->delete();
            $bug = 0;
        } catch (\Exception$e) {
            $bug = $e->errorInfo[1];
        }
        if ($bug == 0) {
            echo "success";
            return $this->sendResponse($voluntarioEst, 'Voluntario estudiante eliminado!');
        } else {
            echo 'error';
        }

    }
}
