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

    public function obtenerCedula(Request $request)
    {
        $filtro = $request->buscadorC;
        $persona = Personas::where('id', $filtro)->get('id');
        return $this->sendResponse($persona, 'Cedula si existe');

    }
    public function obtenerCantidad(Request $request)
    {
        $filtro = $request->VolCantidad;
        $cantidad = Voluntario::where('id', $filtro)->get();
        return $this->sendResponse($cantidad, 'Se encontro el id si existe');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voluntarioEst = $this->voluntarioEstudiantes->latest()->paginate(10);

        return $this->sendResponse($voluntarioEst, 'Lista de estudiantes');
    }

    public function guardarPersona(PersonasRequest $request)
    {
        try {
            $filtro = $request->id;
            $existencia = Personas::where('id', '=', $filtro)->first();
            if ($existencia === null) {
                $tag = $this->personas->create([
                    'id' => $request->get('id'),
                    'nombre' => $request->get('nombre'),
                    'apellido1' => $request->get('apellido1'),
                    'apellido2' => $request->get('apellido2'),
                    'telefono' => $request->get('telefono'),
                    'correo' => $request->get('correo'),
                ]);

                return $this->sendResponse($tag, 'Registro exitoso!');
            } else {
                return response()->json(['success' => false, 'message' => 'Cedula ya existe!']);
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
            'carrera' => 'required|string|max:50',
            'voluntariado_id' => 'required|integer|',
            'imagen' => 'required',
            'idVoluntario' => 'required|integer|min:1',
            'cantidad' => 'required|integer|min:0',
        ];

        $messages = [
            'voluntariado_id.*' => 'Se requiere un id de voluntario y solo números',
            'carrera.*' => 'Se requiere la carrera de la universidad, maximo 50 caracteres',
            'imagen.*' => 'Se requiere la foto del estudiante',
            'idVoluntario.min' => 'minimo un numero en el id del voluntario',
            'idVoluntario.*' => 'Se requiere un id de voluntario',
            'cantidad..min' => 'minimo 0 actividades',
            'cantidad.*' => 'Se requiere la cantidad de actividades',
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
            $existencia = Voluntario::where('id', '=', $filtro)->first();
            if ($existencia === null) {
                $tag = $this->voluntarios->create([
                    'id' => $request->get('idVoluntario'),
                    'cantidad' => $request->get('cantidad'),
                ]);
                $tag = $this->voluntarioEstudiantes->create([
                    'identificacion' => $request->get('identificacion'),
                    'voluntariado_id' => $request->get('voluntariado_id'),
                    'carrera' => $request->get('carrera'),
                    'imagen' => $request->get('imagen'),
                ]);
                return $this->sendResponse($tag, 'Registro exitoso!');
            } else {
                return response()->json(['success' => false, 'message' => 'El id del voluntario ya existe!']);
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
            'carrera' => 'required|string|max:50',
            'voluntariado_id' => 'required|integer|',
            'imagen' => 'required',
            'idVoluntario' => 'required|integer|min:1',
            'cantidad' => 'required|integer|min:0',
        ];

        $messages = [
            'voluntariado_id.*' => 'Se requiere un id de voluntario y solo números',
            'carrera.*' => 'Se requiere la carrera de la universidad, maximo 50 caracteres',
            'imagen.*' => 'Se requiere la foto del estudiante',
            'idVoluntario.min' => 'minimo un numero en el id del voluntario',
            'idVoluntario.*' => 'Se requiere un id de voluntario',
            'cantidad..min' => 'minimo 0 actividades',
            'cantidad.*' => 'Se requiere la cantidad de actividades',
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

        return $this->sendResponse($tag, 'Voluntariado estudiante Actualizado');
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
            return $this->sendResponse($voluntarioEst, 'Voluntario Estudiante eliminado');
        } else {
            echo 'error';
        }

    }
}
