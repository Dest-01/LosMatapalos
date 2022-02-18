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
    Route::post('donativo/guardarPersona', 'DonativosController@guardarPersona');
    Route::post('donativo/guardarOrganizacion', 'DonativosController@guardarOrganizacion');
    Route::get('donativo/listar', 'DonativosController@list');
      /////////////////////////---VOLUNTARIO--ESTUDIANTE---//////////////////////////////////////////////////////////////////
    Route::get('voluntarioEstudiante/obtenerCedula', 'VoluntarioEstudiantesController@obtenerCedula');
    Route::get('voluntarioEstudiante/obtenerCantidad', 'VoluntarioEstudiantesController@obtenerCantidad');
    Route::post('voluntarioEstudiante/guardarPersona', 'VoluntarioEstudiantesController@guardarPersona');
    Route::get('voluntarioEstudiante/listar', 'VoluntarioEstudiantesController@list');
    /////////////////////////---VOLUNTARIO--PERSONA---//////////////////////////////////////////////////////////////////
    Route::get('voluntarioPersona/obtenerCedula', 'VoluntarioPersonaController@obtenerCedula');
    Route::get('voluntarioPersona/obtenerCantidad', 'VoluntarioPersonaController@obtenerCantidad');
    Route::get('voluntarioPersona/cargarVoluntarios', 'VoluntarioPersonaController@cargarVoluntarios');
    Route::post('voluntarioPersona/guardarPersona', 'VoluntarioPersonaController@guardarPersona');
    Route::get('voluntarioPersona/listar', 'VoluntarioPersonaController@list');

    Route::get('GetVoluntarios', 'ActividadesParticipantesController@GetVoluntarios');
   /////////////////////////---RESERVAS---//////////////////////////////////////////////////////////////////
    Route::get('reserva/verificar', 'ReservaController@obtenerCedula');
    Route::get('reserva/verificarOrg', 'ReservaController@obtenerCedulaOrg');
    Route::get('reserva/verificarGrupo', 'ReservaController@obtenerNombreGrupo');
    Route::post('reserva/guardarPersona', 'ReservaController@guardarPersona');
    Route::post('reserva/guardarOrganizacion', 'ReservaController@guardarOrganizacion');
    Route::post('reserva/guardarGrupo', 'ReservaController@GuardarGrupo');
    Route::get('reserva/listar', 'ReservaController@list');
/////////////////////////---VOLUNTARIO ACTIVIDAD---//////////////////////////////////////////////////////////////////
    Route::get('voluntarioActividad/GetActividades', 'VoluntarioActividadesController@GetActividades');
    Route::get('voluntarioActividad/GetVoluntarioEstudiantes', 'VoluntarioActividadesController@GetVoluntarioEstudiantes');
    Route::get('voluntarioActividad/GetVoluntarioPersona', 'VoluntarioActividadesController@GetVoluntarioPersona');
    
    /////////////////////////---RUTAS DASHBOARD---//////////////////////////////////////////////////////////////////
    Route::get('dashboard/TotalPersonas', 'DashboardController@TotalPersonas');
    Route::get('dashboard/TotalActividades', 'DashboardController@TotalActividades');
    Route::get('dashboard/TotalReservaciones', 'DashboardController@TotalReservaciones');
    Route::get('dashboard/TotalDonaciones', 'DashboardController@TotalDonaciones');
    Route::get('dashboard/ultimasReservaciones', 'DashboardController@ultimasReservaciones');
    Route::get('dashboard/ultimasDonaciones', 'DashboardController@ultimasDonaciones');
    Route::get('dashboard/ultimasActividades', 'DashboardController@ultimasActividades');
    ///////////////////////////////------RUSTAS LISTAR PARA IFLTRAR ----------------////////////////////
    Route::get('organizacion/listar', 'OrganizacionesController@list');
    Route::get('personas/listar', 'PersonasController@list');
    Route::get('grupo/listar', 'GruposController@list');
    Route::get('catDonativo/listar', 'CatDonativosController@list');
    Route::get('flora/listar', 'FloraController@list');
    Route::get('fauna/listar', 'FaunaController@list');
    Route::get('actividad/listar', 'ActividadesController@list');
    Route::get('participantes/listar', 'ParticipantesController@list');
    Route::get('repositorio/listar', 'RepositorioDocumentosController@list');
    Route::get('articulos/listar', 'ArticuloController@list');
    //////RUTAS COMPLETAS GET, PUT, POST, DELETE
    Route::apiResources([
        'user' => 'UserController',
        ////RUTAS ADMIN API
        'catDonativo' => 'CatDonativosController',
        'donativo' => 'DonativosController',
        'persona' => 'PersonasController',
        'grupo' => 'GruposController',
        'organizacion' => 'OrganizacionesController',
        'voluntario' => 'VoluntarioController',
        'voluntarioEstudiante' => 'VoluntarioEstudiantesController',
        'voluntarioPersona' => 'VoluntarioPersonaController',
        'actividad' => 'ActividadesController',
        'participantes' => 'ParticipantesController',
        'reserva' => 'ReservaController',
        'voluntarioActividad' => 'VoluntarioActividadesController',
        'fauna' => 'FaunaController',
        'flora' => 'FloraController',
        'articulos'=>'ArticuloController',
        'dashboard' => 'DashboardController',
        'repositorio' => 'RepositorioDocumentosController',
    ]);
});

Route::namespace('App\\Http\\Controllers\\API\client')->group(function () {
        
    Route::get('reservarCliente/verificar', 'ReservarCliController@obtenerCedula');
    Route::get('reservarCliente/verificarOrg', 'ReservarCliController@obtenerCedulaOrg');
    Route::get('reservarCliente/verificarGrupo', 'ReservarCliController@obtenerNombreGrupo');
    Route::post('reservarCliente/persona', 'ReservarCliController@GuardarPersona');
    Route::post('reservarCliente/organizacion', 'ReservarCliController@GuardarOrganizacion');
    Route::post('reservarCliente/grupo', 'ReservarCliController@GuardarGrupo');
    Route::get('donacionesCliente/donacionesNecesarias', 'DonacionController@cargarCategoriaDonativos');
    Route::get('donacionesCliente/Donadores', 'DonacionController@Donadores');
    Route::get('floraCliente/List', 'FloraController@list');
    Route::get('faunaCliente/List', 'FaunaController@list');
    Route::get('repositorioCliente/List', 'RepositorioController@list');

    Route::apiResources([
        'reservarCliente' => 'ReservarCliController',
        'donacionesCliente' => 'DonacionController',
        'floraCliente' => 'FloraController',
        'faunaCliente' => 'FaunaController',
        'actividadCliente' => 'ActividadController',
        'articulosCliente' => 'ArticuloController',
        'repositorioCliente' => 'RepositorioController',
        'voluntariosCliente' => 'VoluntarioEstudiantesController',
    ]);
});