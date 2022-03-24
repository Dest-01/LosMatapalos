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

    Route::get('perfil', 'PerfilController@perfil');
    Route::put('perfil/actualizar', 'PerfilController@actualizarPerfil');
    Route::put('perfil/actualizarFoto', 'PerfilController@actualizarFoto');
    Route::post('perfil/cambiar', 'PerfilController@cambiarPassword');

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
    ///////////////////////////////------RUSTAS LISTAR PARA FILTRAR ----------------////////////////////
    Route::get('organizacion/listar', 'OrganizacionesController@list');
    Route::get('personas/mostrar', 'PersonasController@mostrar');
    Route::get('personas/listar', 'PersonasController@list');
    Route::get('grupo/listar', 'GruposController@list');
    Route::get('catDonativo/listar', 'CatDonativosController@list');
    Route::get('flora/listar', 'FloraController@list');
    Route::get('fauna/listar', 'FaunaController@list');
    Route::get('actividad/listar', 'ActividadesController@list');
    Route::get('participantes/listar', 'ParticipantesController@list');
    Route::get('repositorio/listar', 'RepositorioDocumentosController@list');
    Route::get('articulos/listar', 'ArticuloController@list');
    Route::get('usuarios/listar', 'UserController@list');
    Route::get('historial/listar', 'TriggerUsuariosController@listar');
    Route::get('actividadesPasadas/listar', 'actividadesPasadasController@list');

    //////RUTAS COMPLETAS GET, PUT, POST, DELETE
    Route::apiResources([
        'usuarios' => 'UserController',
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
        'historial' => 'TriggerUsuariosController',
        'perfil' => 'PerfilController',
        'actividadesPasadas' => 'actividadesPasadasController',
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
    Route::get('donacionesCliente/organizaciones', 'DonacionController@ShowOrg');
    Route::get('donacionesCliente/Donadores', 'DonacionController@Donadores');
    Route::get('floraCliente/List', 'FloraController@list');
    Route::get('faunaCliente/List', 'FaunaController@list');
    Route::get('repositorioCliente/List', 'RepositorioController@list');
    Route::get('actividadesPasadasCliente/List', 'actividadesPasadasController@list');

    Route::apiResources([
        'reservarCliente' => 'ReservarCliController',
        'donacionesCliente' => 'DonacionController',
        'floraCliente' => 'FloraController',
        'faunaCliente' => 'FaunaController',
        'actividadCliente' => 'ActividadController',
        'articulosCliente' => 'ArticuloController',
        'repositorioCliente' => 'RepositorioController',
        'voluntariosCliente' => 'VoluntarioEstudiantesController',
        'actividadesPasadasCliente' => 'actividadesPasadasController',
    ]);
});
//API DE REPORTES PARA CONSULTAR DATOS
Route::namespace('App\\Http\\Controllers\\API\Reportes')->group(function () {

    Route::get('ReportePersona/solo10', 'ReportePersonaController@solo10');
    Route::get('ReportePersona/solo25', 'ReportePersonaController@solo25');
    Route::get('ReportePersona/solo50', 'ReportePersonaController@solo50');
    Route::get('ReportePersona/solo75', 'ReportePersonaController@solo75');
    Route::get('ReportePersona/solo100', 'ReportePersonaController@solo100');
    Route::get('ReportePersona/todo', 'ReportePersonaController@todo');

    ////////////////////////////////////////////////////////////////////////
   
    Route::get('ReporteOrganizacion/solo10', 'ReporteOrganizacionController@solo10');
    Route::get('ReporteOrganizacion/solo25', 'ReporteOrganizacionController@solo25');
    Route::get('ReporteOrganizacion/solo50', 'ReporteOrganizacionController@solo50');
    Route::get('ReporteOrganizacion/solo75', 'ReporteOrganizacionController@solo75');
    Route::get('ReporteOrganizacion/solo100', 'ReporteOrganizacionController@solo100');
    Route::get('ReporteOrganizacion/todo', 'ReporteOrganizacionController@todo');

    ////////////////////////////////////////////////////////////////////////
    
    Route::get('ReporteGrupo/solo10', 'ReporteGrupoController@solo10');
    Route::get('ReporteGrupo/solo25', 'ReporteGrupoController@solo25');
    Route::get('ReporteGrupo/solo50', 'ReporteGrupoController@solo50');
    Route::get('ReporteGrupo/solo75', 'ReporteGrupoController@solo75');
    Route::get('ReporteGrupo/solo100', 'ReporteGrupoController@solo100');
    Route::get('ReporteGrupo/todo', 'ReporteGrupoController@todo');

    ////////////////////////////////////////////////////////////////////////
    
    Route::get('ReportesDonativos/solo10', 'ReportesDonativosController@solo10');
    Route::get('ReportesDonativos/solo25', 'ReportesDonativosController@solo25');
    Route::get('ReportesDonativos/solo50', 'ReportesDonativosController@solo50');
    Route::get('ReportesDonativos/solo75', 'ReportesDonativosController@solo75');
    Route::get('ReportesDonativos/solo100', 'ReportesDonativosController@solo100');
    Route::get('ReportesDonativos/todo', 'ReportesDonativosController@todo');

    ////////////////////////////////////////////////////////////////////////

    Route::get('ReporteVoluntariosParti/solo10', 'ReporteVoluntariosPartiController@solo10');
    Route::get('ReporteVoluntariosParti/solo25', 'ReporteVoluntariosPartiController@solo25');
    Route::get('ReporteVoluntariosParti/solo50', 'ReporteVoluntariosPartiController@solo50');
    Route::get('ReporteVoluntariosParti/solo75', 'ReporteVoluntariosPartiController@solo75');
    Route::get('ReporteVoluntariosParti/solo100', 'ReporteVoluntariosPartiController@solo100');
    Route::get('ReporteVoluntariosParti/todo', 'ReporteVoluntariosPartiController@todo');

    ////////////////////////////////////////////////////////////////////////

    Route::get('ReporteVoluntariosEstudiante/solo10', 'ReporteVoluntariosEstudianteController@solo10');
    Route::get('ReporteVoluntariosEstudiante/solo25', 'ReporteVoluntariosEstudianteController@solo25');
    Route::get('ReporteVoluntariosEstudiante/solo50', 'ReporteVoluntariosEstudianteController@solo50');
    Route::get('ReporteVoluntariosEstudiante/solo75', 'ReporteVoluntariosEstudianteController@solo75');
    Route::get('ReporteVoluntariosEstudiante/solo100', 'ReporteVoluntariosEstudianteController@solo100');
    Route::get('ReporteVoluntariosEstudiante/todo', 'ReporteVoluntariosEstudianteController@todo');

    ////////////////////////////////////////////////////////////////////////

    Route::get('ReporteActividades/solo10', 'ReporteActividadesController@solo10');
    Route::get('ReporteActividades/solo25', 'ReporteActividadesController@solo25');
    Route::get('ReporteActividades/solo50', 'ReporteActividadesController@solo50');
    Route::get('ReporteActividades/solo75', 'ReporteActividadesController@solo75');
    Route::get('ReporteActividades/solo100', 'ReporteActividadesController@solo100');
    Route::get('ReporteActividades/todo', 'ReporteActividadesController@todo');

    ////////////////////////////////////////////////////////////////////////

    Route::get('ReporteVoluntarioActividad/solo10', 'ReporteVoluntarioActividadController@solo10');
    Route::get('ReporteVoluntarioActividad/solo25', 'ReporteVoluntarioActividadController@solo25');
    Route::get('ReporteVoluntarioActividad/solo50', 'ReporteVoluntarioActividadController@solo50');
    Route::get('ReporteVoluntarioActividad/solo75', 'ReporteVoluntarioActividadController@solo75');
    Route::get('ReporteVoluntarioActividad/solo100', 'ReporteVoluntarioActividadController@solo100');
    Route::get('ReporteVoluntarioActividad/todo', 'ReporteVoluntarioActividadController@todo');

    ////////////////////////////////////////////////////////////////////////

    Route::get('ReporteReservas/solo10', 'ReporteReservasController@solo10');
    Route::get('ReporteReservas/solo25', 'ReporteReservasController@solo25');
    Route::get('ReporteReservas/solo50', 'ReporteReservasController@solo50');
    Route::get('ReporteReservas/solo75', 'ReporteReservasController@solo75');
    Route::get('ReporteReservas/solo100', 'ReporteReservasController@solo100');
    Route::get('ReporteReservas/todo', 'ReporteReservasController@todo');

    ////////////////////////////////////////////////////////////////////////

    Route::get('ReporteFauna/solo10', 'ReporteFaunaController@solo10');
    Route::get('ReporteFauna/solo25', 'ReporteFaunaController@solo25');
    Route::get('ReporteFauna/solo50', 'ReporteFaunaController@solo50');
    Route::get('ReporteFauna/solo75', 'ReporteFaunaController@solo75');
    Route::get('ReporteFauna/solo100', 'ReporteFaunaController@solo100');
    Route::get('ReporteFauna/todo', 'ReporteFaunaController@todo');

    ////////////////////////////////////////////////////////////////////////

    Route::get('ReporteFlora/solo10', 'ReporteFloraController@solo10');
    Route::get('ReporteFlora/solo25', 'ReporteFloraController@solo25');
    Route::get('ReporteFlora/solo50', 'ReporteFloraController@solo50');
    Route::get('ReporteFlora/solo75', 'ReporteFloraController@solo75');
    Route::get('ReporteFlora/solo100', 'ReporteFloraController@solo100');
    Route::get('ReporteFlora/todo', 'ReporteFloraController@todo');

    ////////////////////////////////////////////////////////////////////////

    Route::apiResources([
        'ReportePersona' => 'ReportePersonaController',
    ]);

});