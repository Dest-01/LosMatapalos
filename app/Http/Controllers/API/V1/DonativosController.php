<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Admin\PersonasRequest;
use App\Http\Requests\Admin\OrganizacionesRequest;
use App\Models\Donativos;
use App\Models\Organizaciones;
use App\Models\Personas;
use Illuminate\Http\Request;

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

    function list() {
        $donativo = $this->donativos->get();
        //  $products = $this->product->latest()->with('category', 'tags')->paginate(10);

        return $this->sendResponse($donativo, 'Lista Donativos');
    }

    public function obtenerCedula(Request $request)
    {
        $filtro = $request->buscador;
        $persona = Personas::where('identificacion', $filtro)->get();
        return $this->sendResponse($persona, 'Cedula si existe!');

    }
    public function obtenerCedulaOrg(Request $request)
    {
        $filtro = $request->buscador;
        $organizacion = Organizaciones::where('identificacion', $filtro)->get();
        return $this->sendResponse($organizacion, 'Identificación si existe!');
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

    public function guardarOrganizacion(OrganizacionesRequest $request)
    {
        try {
            $filtro = $request->identificacion;
            $existencia = Organizaciones::where('identificacion', '=', $filtro)->first();
            if ($existencia === null) {
                $tag = $this->organizaciones->create([
                    'identificacion' => $request->get('identificacion'),
                    'nombre' => $request->get('nombre'),
                    'telefono' => $request->get('telefono'),
                    'correo' => $request->get('correo'),
                ]);

                return $this->sendResponse($tag, 'Organización registrada!');
            } else {
                return response()->json(['success' => false, 'message' => 'Cédula jurídica ya existe!']);
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
        try {
            $rules = [
                'tipo' => 'required|string|max:50',
                'detalle' => 'required|string|min:3|max:255|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
                'fecha' => 'required|date|after:2000-01-01',
                'photo' => 'required|sometimes|base64image:png,jpeg,jpg',
                'estado' => 'required|string|',

            ];

            $messages =[
                'tipo.*' => 'Seleccione un tipo de donativo',
                'detalle.min' => "Mínimo 3 caracteres",
                'detalle.max' => "Máximo 255 caracteres",
                'detalle.*' => 'Breve descripción del donativo',
                'fecha.*' => 'Seleccione fecha de donativo',
                'photo.sometimes' => 'Solo imagenes, jpeg, jpg o png',
                'photo.base64image' => 'Solo imagenes, jpeg, jpg o png',
                'photo.*' => 'Cargue una foto',
                'estado.*' => 'Seleccione un estado del donativo',
            ];

            $this->validate($request, $rules, $messages);

            if ($request->photo) {
                $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
                (!file_exists(public_path() . '/images/donativos/')) ? mkdir(public_path() . '/images/donativos/', 0777, true) : null;
                \Image::make($request->photo)->save(public_path('images/donativos/') . $name);
                $request->merge(['photo' => $name]);

            }

            $tag = $this->donativos->create([
                'tipo' => $request->get('tipo'),
                'idPersona' => $request->get('idPersona'),
                'identificacionPersona' => $request->get('identificacionPersona'),
                'idOrganizacion' => $request->get('idOrganizacion'),
                'identificacionOrganizacion' => $request->get('identificacionOrganizacion'),
                'detalle' => $request->get('detalle'),
                'photo' => $request->get('photo'),
                'fecha' => $request->get('fecha'),
                'estado' => $request->get('estado'),

            ]);
            return $this->sendResponse($tag, 'Donativo registrado!');
        } catch (\PDOException | Exception $e) {
            return response()->json(["errors" => $e->getMessage()], 500);
        }
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
    public function update(Request $request, $id)
    {
        $rules = [
            'tipo' => 'required|string|max:50',
            'detalle' => 'required|string|min:3|max:255|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'fecha' => 'required|date|after:2000-01-01',
            'estado' => 'required|string|',

        ];

        $messages = [
            'tipo.*' => 'Seleccione un tipo de donativo',
                'detalle.min' => "Mínimo 3 caracteres",
                'detalle.max' => "Máximo 255 caracteres",
                'detalle.*' => 'Breve descripción del donativo',
                'fecha.*' => 'Seleccione fecha de donativo',
                'photo.base64image' => 'Solo imagenes, jpeg, jpg o png',
                'estado.*' => 'Seleccione un estado del donativo',
        ];

        $this->validate($request, $rules, $messages);

        $tag = $this->donativos->findOrFail($id);

        $currentPhoto = $tag->photo;

        if ($request->photo != $currentPhoto) {
            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('images/donativos/') . $name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('images/donativos/') . $currentPhoto;
            if (file_exists($userPhoto)) {
                @unlink($userPhoto);
            }

        }

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Donativo actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donativos  $donativos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donativos = Donativos::FindOrFail($id);
        if (file_exists('images/donativos/' . $donativos->photo) and !empty($donativos->photo)) {
            unlink('images/donativos/' . $donativos->photo);
        }
        try {

            $donativos->delete();
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];

        }
        if ($bug == 0) {
            echo "success";
        } else {
            echo 'error';

        }
        
    }
}
