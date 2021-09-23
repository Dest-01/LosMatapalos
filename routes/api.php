<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    Log::debug('User:' . serialize($request->user()));
    return $request->user();
});

//////////Grupo de rutas para los controladores en la carpeta API V1
Route::namespace('App\\Http\\Controllers\\API\V1')->group(function () {
    Route::get('profile', 'ProfileController@profile');
    Route::put('profile', 'ProfileController@updateProfile');
    Route::post('change-password', 'ProfileController@changePassword');

    ///////Rutas Personalizadas o especificas a un metodo
    Route::get('donativo/verificar', 'DonativosController@obtenerCedula');
    Route::get('donativo/verificarOrg', 'DonativosController@obtenerCedulaOrg');
      /////////////////////////---VOLUNTARIO--ESTUDIANTE---//////////////////////////////////////////////////////////////////
    Route::get('voluntarioEstudiante/obtenerCedula', 'VoluntarioEstudiantesController@obtenerCedula');
    Route::get('voluntarioEstudiante/NombreVoluntario', 'VoluntarioEstudiantesController@obtenerNombreVoluntario');
    /////////////////////////---VOLUNTARIO--PERSONA---//////////////////////////////////////////////////////////////////
    Route::get('voluntarioPersona/obtenerCedula', 'VoluntarioPersonaController@obtenerCedula');
    Route::get('voluntarioPersona/NombreVoluntario', 'VoluntarioPersonaController@obtenerNombreVoluntario');

    //////RUTAS COMPLETAS GET, PUT, POST, DELETE
    Route::apiResources([
        'user' => 'UserController',
        'product' => 'ProductController',
        'category' => 'CategoryController',
        'tag' => 'TagController',
        'test' => 'TestController',
        ////RUTAS ADMIN API
        'catDonativo' => 'CatDonativosController',
        'donativo' => 'DonativosController',
        'persona' => 'PersonasController',
        'organizacion' => 'OrganizacionesController',
        'voluntario' => 'VoluntarioController',
        'voluntarioEstudiante' => 'VoluntarioEstudiantesController',
        'voluntarioPersona' => 'VoluntarioPersonaController',
        'actividad' => 'ActividadesController',
    ]);
});

Route::namespace('App\\Http\\Controllers\\API\client')->group(function () {
        
    Route::get('reservarCliente/verificar', 'ReservarCliController@obtenerCedula');
    Route::get('reservarCliente/verificarOrg', 'ReservarCliController@obtenerCedulaOrg');
    Route::post('reservarCliente/persona', 'ReservarCliController@GuardarPersona');
    Route::post('reservarCliente/organizacion', 'ReservarCliController@GuardarOrganizacion');

    Route::apiResources([
        'reservarCliente' => 'ReservarCliController',
    ]);
});