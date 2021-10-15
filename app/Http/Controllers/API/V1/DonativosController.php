<?php

namespace App\Http\Controllers\API\V1;

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
    public function store(Request $request)
    {
        try {
            $rules = [
                'tipo' => 'required|string|max:50',
                'detalle' => 'required|string|max:255',
                'fecha' => 'required|date',
                'photo' => 'required',
                'estado' => 'required|string|',

            ];

            $messages = [
                'tipo.*' => 'Seleccione un tipo de donativo',
                'detalle.*' => 'Breve descripción del donativo',
                'fecha.*' => 'Seleccione fecha de donativo',
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
                'idOrganizacion' => $request->get('idOrganizacion'),
                'detalle' => $request->get('detalle'),
                'photo' => $request->get('photo'),
                'fecha' => $request->get('fecha'),
                'estado' => $request->get('estado'),

            ]);
            return $this->sendResponse($tag, 'Donativo creado');
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
            'detalle' => 'required|string|max:255',
            'fecha' => 'required|date',
            'estado' => 'required|string|',

        ];

        $messages = [
            'tipo.*' => 'Seleccione un tipo de donativo',
            'detalle.*' => 'Breve descripción del donativo',
            'fecha.*' => 'Seleccione fecha de donativo',
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
        if (file_exists('images/donativos/' . $donativos->photo) and !empty($donativos->photo)) {
            unlink('images/donativos/' . $donativos->photo);
        }
        try {

            $donativos->delete();
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
