<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('cliente');
});

Route::get('login', function () {
    return view('login');
});

Auth::routes(['verify' => true]);

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/cliente', [App\Http\Controllers\ClienteController::class, 'index'])->name('cliente');


////////////////////////////////////////////////////////////////////////////
//-----------------------RUTAS ADMIN Y PRUEBAS------------------------------
////////////////////////////////////////////////////////////////////////////

Route::get('/admin/dashboard', function () {
    return view('admin');
})->where('/admin/dashboard', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/perfil', function () {
    return view('admin');
})->where('/admin/perfil', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/usuarios', function () {
    return view('admin');
})->where('/admin/usuarios', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/reportes', function () {
    return view('admin');
})->where('admin/reportes', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/reporte', function () {
    return view('admin');
})->where('/admin/reporte', '[\/\w\.-]*')->middleware('auth');


/////////////////////----FIN-ADMIN Y PRUEBAS---//////////////////////////////

////////////////////////////////////////////////////////////////////////////
//-----------------------PERSONAS ORGANIZACION------------------------------
////////////////////////////////////////////////////////////////////////////
Route::get('/admin/personas', function () {
    return view('admin');
})->where('admin/personas', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/organizaciones', function () {
    return view('admin');
})->where('admin/organizaciones', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/grupos', function () {
    return view('admin');
})->where('admin/grupos', '[\/\w\.-]*')->middleware('auth');
/////////////////////----FIN-PERSONAS ORGANIZACION---///////////////////////
///////////////////////////////////////////////////////////////////////////
//-----------------------DONATIVOS-----------------------------------------
///////////////////////////////////////////////////////////////////////////
Route::get('/admin/donativos', function () {
    return view('admin');
})->where('admin/donativos', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/Catdonativos', function () {
    return view('admin');
})->where('admin/Catdonativos', '[\/\w\.-]*')->middleware('auth');
///////////////////////////////----FIN-DONATIVOS---////////////////////////
///////////////////////////////////////////////////////////////////////////
//-----------------------RESERVAR-----------------------------------------
///////////////////////////////////////////////////////////////////////////
Route::get('/admin/reservar', function () {
    return view('admin');
})->where('/admin/reservar', '[\/\w\.-]*')->middleware('auth');

////////////////////////////----FIN-RESERVAR---//////////////////////////////
///////////////////////////////////////////////////////////////////////////
//-----------------------VOLUNTARIADO--------------------------------------
///////////////////////////////////////////////////////////////////////////
Route::get('/admin/voluntario', function () {
    return view('admin');
})->where('admin/voluntario', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/voluntarioPersona', function () {
    return view('admin');
})->where('admin/voluntarioPersona', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/voluntarioEstudiante', function () {
    return view('admin');
})->where('admin/voluntarioEstudiante', '[\/\w\.-]*')->middleware('auth');
Route::get('/admin/actividad', function(){
    return view('admin');
})->where('admin/actividad', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/participantes', function(){
    return view('admin');
})->where('admin/participantes', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/voluntarioActividad', function(){
    return view('admin');
})->where('admin/voluntarioActividad', '[\/\w\.-]*')->middleware('auth');

///////////////////////////////----FIN--VOLUNTARIADO--///////////////////////
///////////////////////////////////////////////////////////////////////////
//-----------------------BIODIVERSIDAD--------------------------------------
///////////////////////////////////////////////////////////////////////////
Route::get('/admin/fauna', function(){
    return view('admin');
})->where('admin/fauna', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/flora', function () {
    return view('admin');
})->where('admin/flora', '[\/\w\.-]*')->middleware('auth');
Route::get('/admin/eventos', function(){
    return view('admin');
})->where('admin/eventos', '[\/\w\.-]*')->middleware('auth');
///////////////////////////////----FIN--BIODIVERSIDAD--///////////////////////
Route::get('/admin/repositorio', function () {
    return view('admin');
})->where('admin/repositorio', '[\/\w\.-]*')->middleware('auth');
///////////////////////////////////////////////////////////////////////////
Route::get('/admin/articulos', function(){
    return view('admin');
})->where('/admin/articulos', '[\/\w\.-]*')->middleware('auth');
///////////////////////////////////////////////////////////////////////////
//-----------------------RUTAS PARA EL CLIENTE SIN LOGIN-------------------
///////////////////////////////////////////////////////////////////////////
Route::get('/{vue_capture?}', function () {
    return view('cliente');
})->where('vue_capture', '[\/\w\.-]*');
///////////////////////////////----FIN-RUTAS--CLIENTE---//////////////////////



