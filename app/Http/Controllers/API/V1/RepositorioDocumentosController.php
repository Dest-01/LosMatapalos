<?php

namespace App\Http\Controllers\API\V1;

use App\Models\RepositorioDocumentos;
use Illuminate\Http\Request;

class RepositorioDocumentosController extends BaseController
{

    protected $repositorioDocumentos;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->repositorioDocumentos = new RepositorioDocumentos();
    }

    public function index()
    {
        $repositorioDocumentos = $this->repositorioDocumentos->latest()->paginate(5);
        return $this->sendResponse($repositorioDocumentos,"Lista de Repositorios");
    }

    public function list()
    {
        $repositorioDocumentos = $this->repositorioDocumentos->get();
        return $this->sendResponse($repositorioDocumentos,"Lista de Repositorios");
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
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|min:3|max:255|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'fecha' => 'required|date|after:2000-01-01',

        ];

        $messages = [
                'nombre.*' => "Se requiere un nombre",
                'descripcion.min' => "Mínimo 3 caracteres",
                'descripcion.max' => "Máximo 255 caracteres",
                'descripcion.*' => 'Breve descripción del donativo',
                'fecha.*' => 'Seleccione fecha de donativo',
        ];

        try{
            $repositorioDocumentos = $request->all();
            if($repositorioDocumentos['documento']) {
                $document_explode = explode(',', $repositorioDocumentos['documento']);
                $documento = base64_decode($document_explode[1]);
                $archivo_nombre = $repositorioDocumentos['nombre'].time().'.'.$this->getFileExtension($document_explode[0]);
                (!file_exists(public_path().'/documentos/repositorioDocumental/')) ? mkdir(public_path().'/documentos/repositorioDocumental/', 0777, true) : null;
                $path = '/documentos/repositorioDocumental/'.$archivo_nombre;
                file_put_contents(public_path().$path , $documento) ? $path : false;
                $repositorioDocumentos['documento'] = $archivo_nombre; 
            }
            if ($repositorioResult = RepositorioDocumentos::create($repositorioDocumentos)):
                return $this->sendResponse($repositorioResult, 'Documento guardado!');
            endif;
            return $this->sendResponse('Documento no guardado!');
        }catch(\Exception $e){
             return response()->json([
                 'message'=>$e->getMessage()
             ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RepositorioDocumentos  $repositorioDocumentos
     * @return \Illuminate\Http\Response
     */
    public function show(RepositorioDocumentos $repositorioDocumentos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RepositorioDocumentos  $repositorioDocumentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|min:3|max:255|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'fecha' => 'required|date|after:2000-01-01',

        ];

        $messages = [
                'nombre.*' => "Se requiere un nombre",
                'descripcion.min' => "Mínimo 3 caracteres",
                'descripcion.max' => "Máximo 255 caracteres",
                'descripcion.*' => 'Breve descripción del donativo',
                'fecha.*' => 'Seleccione fecha de donativo',
        ];
        
        try{
            $repositorioDocumentos = RepositorioDocumentos::FindOrFail($id);
            $documentoActual =  $repositorioDocumentos['documento'];
            if($repositorioDocumentos['documento'] =! $documentoActual){

            }


            $document_explode = explode(',', $repositorioDocumentos['documento']);
            $documento = base64_decode($document_explode[1]);
            $archivo_nombre = $repositorioDocumentos['nombre'].time().'.'.$this->getFileExtension($document_explode[0]);
            (!file_exists(public_path().'/documentos/repositorioDocumental/')) ? mkdir(public_path().'/documentos/repositorioDocumental/', 0777, true) : null;
            $path = '/documentos/repositorioDocumental/'.$archivo_nombre;
            file_put_contents(public_path().$path , $documento) ? $path : false;
            $repositorioDocumentos['documento'] = $archivo_nombre; // $path;









            if($repositorioResult =  $repositorioDocumentos->update($request->all())):
                return $this->sendResponse($repositorioResult, 'Documento Actualizado!');
            endif;
            return $this->sendResponse('No se actualizo!');
        }catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage()
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RepositorioDocumentos  $repositorioDocumentos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repositorioDocumentos = RepositorioDocumentos::FindOrFail($id);
        if(file_exists('documentos/repositorioDocumental/'. $repositorioDocumentos['documento']) AND !empty( $repositorioDocumentos['documento'])){
            unlink('documentos/repositorioDocumental/'. $repositorioDocumentos['documento']);
        }try{
            $repositorioDocumentos->delete();
            $bug = 0;
        }catch(\Exception $e){
            $bug = $e->errorInfo[1];
        }if($bug==0){
           echo "success";
        }else{
           echo 'error';
        }

    }

    private function getFileExtension ($extension) {
        $ext = null;
        if(strpos($extension, 'pdf')):
            $ext = 'pdf';
        elseif(strpos($extension,'docx')):
            $ext = 'docx';
        else:
            $ext = 'pdf';
            $ext = 'docx';
        endif;

        return $ext;
    }
}
