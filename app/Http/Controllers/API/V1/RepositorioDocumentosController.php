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
		$repositorioDocumentos = $this->repositorioDocumentos->latest()->paginate(10);
		return $this->sendResponse($repositorioDocumentos, "Lista de Repositorios!");
	}

	public function mostrar(Request $request)
    {
        $filtro = $request->valor;

        $repositorioDocumentos = $this->repositorioDocumentos->latest()->paginate($filtro);

        return $this->sendResponse($repositorioDocumentos, 'Lista de Repositorios!');
    }

	public function list()
	{
		$repositorioDocumentos = $this->repositorioDocumentos->get();
		return $this->sendResponse($repositorioDocumentos, "Lista de Repositorios!");
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
			'nombre' => 'required|string|max:400',
			'descripcion' => 'required|string|min:3|max:600|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
			'fecha' => 'required|date|after:2000-01-01',

		];
		$messages = [
			'nombre.*' => "Se requiere un nombre",
			'descripcion.min' => "Mínimo 3 caracteres",
			'descripcion.max' => "Máximo 600 caracteres",
			'descripcion.*' => 'Breve descripción del documento',
			'fecha.*' => 'Seleccione fecha del documento',
		];
		$this->validate($request, $rules,$messages);
		try {
			$repositorioDocumentos = $request->all();
			if ($repositorioDocumentos['documento']) {
				$uploadedFile = $this->uploadFiles($repositorioDocumentos['documento'], $repositorioDocumentos['nombre']);
				$repositorioDocumentos['documento'] = $uploadedFile['file'];
			}
			if ($repositorioResult = RepositorioDocumentos::create($repositorioDocumentos)) :
				return $this->sendResponse($repositorioResult, 'Documento guardado!');
			endif;
			return $this->sendResponse('Documento no guardado');
		} catch (\Exception $e) {
			return response()->json([
				'message' => $e->getMessage()
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
		try {
			$repositorioDocumentos = RepositorioDocumentos::FindOrFail($id);
			$folderPath = 'documentos/repositorioDocumental/';

			$repositorioDocumentosUpdate = $request->all();
			$documento = $repositorioDocumentosUpdate['documento'];

			// PDF Flow
			if ($documento):
				// Delete previous document
				unlink($folderPath . $repositorioDocumentos['documento']);
				// Upload new document file
				$uploadedFile = $this->uploadFiles($documento, $repositorioDocumentosUpdate['nombre']);
				$repositorioDocumentosUpdate['documento'] = $uploadedFile['file'];
			else:
				// Assign the same name of model
				$fileNameDocument = $repositorioDocumentosUpdate['nombre'] . time() . '.' . explode('.', $repositorioDocumentos['documento'])[1];
				$repositorioDocumentosUpdate['documento'] = $fileNameDocument;
				rename(
					$folderPath . $repositorioDocumentos['documento'], 
					$folderPath . $fileNameDocument
				);
			endif;
			$repositorioDocumentos->update($repositorioDocumentosUpdate);
			return $this->sendResponse($repositorioDocumentos, 'El documento ha sido actualizado!');
		} catch (\Exception $e) {
			return response()->json([
				'message' => $e->getMessage()
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
		if (file_exists('documentos/repositorioDocumental/' . $repositorioDocumentos['documento']) and !empty($repositorioDocumentos['documento'])) {
			unlink('documentos/repositorioDocumental/' . $repositorioDocumentos['documento']);
		}
		try {
			$repositorioDocumentos->delete();
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

	private function getFileExtension($extension)
	{
		$ext = null;
		if (strpos($extension, 'pdf')) :
			$ext = 'pdf';
		elseif (strpos($extension, 'docx')) :
			$ext = 'docx';
		else :
			$ext = 'pdf';
			$ext = 'docx';
		endif;

		return $ext;
	}

	private function uploadFiles($fileBase64, $fileName) {
		$folderPath = '/documentos/repositorioDocumental/';
		$document_explode = explode(',', $fileBase64);
		$documento = base64_decode($document_explode[1]);
		$fileNameWithExt = $fileName . '-' . time() . '.' . $this->getFileExtension($document_explode[0]);
		
		// Create folder path if not exist
		(!file_exists(public_path() . $folderPath)) 
		? mkdir(public_path() . $folderPath, 0777, true) 
		: null;

		$path = $folderPath . $fileNameWithExt;
		file_put_contents(public_path() . $path, $documento) ? $path : false;

		return [
			'file' => $fileNameWithExt,
			'isSuccess' => true
		];
	}
}

