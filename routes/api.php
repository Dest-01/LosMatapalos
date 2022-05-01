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
    Route::get('donativo/mostrar', 'DonativosController@mostrar');
      /////////////////////////---VOLUNTARIO--ESTUDIANTE---//////////////////////////////////////////////////////////////////
    Route::get('voluntarioEstudiante/obtenerCedula', 'VoluntarioEstudiantesController@obtenerCedula');
    Route::get('voluntarioEstudiante/obtenerCantidad', 'VoluntarioEstudiantesController@obtenerCantidad');
    Route::post('voluntarioEstudiante/guardarPersona', 'VoluntarioEstudiantesController@guardarPersona');
    Route::get('voluntarioEstudiante/listar', 'VoluntarioEstudiantesController@list');
    Route::get('voluntarioEstudiante/mostrar', 'VoluntarioEstudiantesController@mostrar');
    /////////////////////////---VOLUNTARIO--PERSONA---//////////////////////////////////////////////////////////////////
    Route::get('voluntarioPersona/obtenerCedula', 'VoluntarioPersonaController@obtenerCedula');
    Route::get('voluntarioPersona/obtenerCantidad', 'VoluntarioPersonaController@obtenerCantidad');
    Route::get('voluntarioPersona/cargarVoluntarios', 'VoluntarioPersonaController@cargarVoluntarios');
    Route::post('voluntarioPersona/guardarPersona', 'VoluntarioPersonaController@guardarPersona');
    Route::get('voluntarioPersona/listar', 'VoluntarioPersonaController@list');
    Route::get('voluntarioPersona/mostrar', 'VoluntarioPersonaController@mostrar');

    Route::get('GetVoluntarios', 'ActividadesParticipantesController@GetVoluntarios');
   /////////////////////////---RESERVAS---//////////////////////////////////////////////////////////////////
    Route::get('reserva/verificar', 'ReservaController@obtenerCedula');
    Route::get('reserva/verificarOrg', 'ReservaController@obtenerCedulaOrg');
    Route::get('reserva/verificarGrupo', 'ReservaController@obtenerNombreGrupo');
    Route::post('reserva/guardarPersona', 'ReservaController@guardarPersona');
    Route::post('reserva/guardarOrganizacion', 'ReservaController@guardarOrganizacion');
    Route::post('reserva/guardarGrupo', 'ReservaController@GuardarGrupo');
    Route::get('reserva/listar', 'ReservaController@list');
    Route::get('reserva/mostrar', 'ReservaController@mostrar');
/////////////////////////---VOLUNTARIO ACTIVIDAD---//////////////////////////////////////////////////////////////////
    Route::get('voluntarioActividad/listar', 'VoluntarioActividadesController@list');
    Route::get('voluntarioActividad/mostrar', 'VoluntarioActividadesController@mostrar');
    Route::get('voluntarioActividad/voluntarioEst', 'VoluntarioActividadesController@listarVoluntarioEstudiantes');
    Route::get('voluntarioActividad/voluntarioPer', 'VoluntarioActividadesController@listarVoluntarioPersonas');
    
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
    Route::get('organizacion/mostrar', 'OrganizacionesController@mostrar');
    Route::get('personas/mostrar', 'PersonasController@mostrar');
    Route::get('personas/listar', 'PersonasController@list');
    Route::get('grupo/listar', 'GruposController@list');
    Route::get('grupo/mostrar', 'GruposController@mostrar');
    Route::get('catDonativo/listar', 'CatDonativosController@list');
    Route::get('catDonativo/mostrar', 'CatDonativosController@mostrar');
    Route::get('flora/listar', 'FloraController@list');
    Route::get('flora/mostrar', 'FloraController@mostrar');
    Route::get('fauna/listar', 'FaunaController@list');
    Route::get('fauna/mostrar', 'FaunaController@mostrar');
    Route::get('actividad/listar', 'ActividadesController@list');
    Route::get('actividad/mostrar', 'ActividadesController@mostrar');
    Route::get('participantes/listar', 'ParticipantesController@list');
    Route::get('participantes/mostrar', 'ParticipantesController@mostrar');
    Route::get('repositorio/listar', 'RepositorioDocumentosController@list');
    Route::get('repositorio/mostrar', 'RepositorioDocumentosController@mostrar');
    Route::get('articulos/listar', 'ArticuloController@list');
    Route::get('articulos/mostrar', 'ArticuloController@mostrar');
    Route::get('usuarios/listar', 'UserController@list');
    Route::get('usuarios/mostrar', 'UserController@mostrar');
    Route::get('historial/listar', 'TriggerUsuariosController@listar');
    Route::get('actividadesPasadas/listar', 'actividadesPasadasController@list');
    Route::get('actividadesPasadas/mostrar', 'actividadesPasadasController@mostrar');
    Route::put('calculoActividad/restar', 'CalculosController@actualizarparticipantes');
    

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

    Route::get('ReportePersona/filtro', 'ReportePersonaController@filtro');
    Route::get('ReportePersona/todo', 'ReportePersonaController@todo');
    ////////////////////////////////////////////////////////////////////////
    Route::get('ReporteOrganizacion/filtro', 'ReporteOrganizacionController@filtro');
    Route::get('ReporteOrganizacion/todo', 'ReporteOrganizacionController@todo');
    ////////////////////////////////////////////////////////////////////////
    Route::get('ReporteGrupo/filtro', 'ReporteGrupoController@filtro');
    Route::get('ReporteGrupo/todo', 'ReporteGrupoController@todo');
    ////////////////////////////////////////////////////////////////////////  
    Route::get('ReportesDonativos/filtro', 'ReportesDonativosController@filtro');
    Route::get('ReportesDonativos/todo', 'ReportesDonativosController@todo');
    ////////////////////////////////////////////////////////////////////////
    Route::get('ReporteVoluntariosParti/filtro', 'ReporteVoluntariosPartiController@filtro');;
    Route::get('ReporteVoluntariosParti/todo', 'ReporteVoluntariosPartiController@todo');
    ////////////////////////////////////////////////////////////////////////
    Route::get('ReporteVoluntariosEstudiante/filtro', 'ReporteVoluntariosEstudianteController@filtro');
    Route::get('ReporteVoluntariosEstudiante/todo', 'ReporteVoluntariosEstudianteController@todo');
    ////////////////////////////////////////////////////////////////////////
    Route::get('ReporteActividades/filtro', 'ReporteActividadesController@filtro');
    Route::get('ReporteActividades/todo', 'ReporteActividadesController@todo');
    ////////////////////////////////////////////////////////////////////////
    Route::get('ReporteVoluntarioActividad/filtro', 'ReporteVoluntarioActividadController@filtro');
    Route::get('ReporteVoluntarioActividad/todo', 'ReporteVoluntarioActividadController@todo');
    ////////////////////////////////////////////////////////////////////////
    Route::get('ReporteReservas/filtro', 'ReporteReservasController@filtro');
    Route::get('ReporteReservas/todo', 'ReporteReservasController@todo');
    ////////////////////////////////////////////////////////////////////////
    Route::get('ReporteFauna/filtro', 'ReporteFaunaController@filtro');
    Route::get('ReporteFauna/todo', 'ReporteFaunaController@todo');
    ////////////////////////////////////////////////////////////////////////
    Route::get('ReporteFlora/filtro', 'ReporteFloraController@filtro');
    Route::get('ReporteFlora/todo', 'ReporteFloraController@todo');
    ////////////////////////////////////////////////////////////////////////
    Route::get('ReporteParticipantes/filtro', 'ReporteParticipantesController@filtro');
    Route::get('ReporteParticipantes/todo', 'ReporteParticipantesController@todo');
    ////////////////////////////////////////////////////////////////////////
    Route::apiResources([
        'ReportePersona' => 'ReportePersonaController',
    ]);

});