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

Route::get('admin', function () {
    return redirect('/dashboard');
});

////////////////////////////////////////////////////////////////////////////
//-----------------------RUTAS ADMIN Y PRUEBAS------------------------------
////////////////////////////////////////////////////////////////////////////
Route::get('/dashboard', function () {
    return view('admin');
})->where('dashboard', '[\/\w\.-]*')->middleware('auth');

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

///////////////////////////////----FIN--VOLUNTARIADO--///////////////////////
///////////////////////////////////////////////////////////////////////////
//-----------------------RUTAS PARA EL CLIENTE SIN LOGIN-------------------
///////////////////////////////////////////////////////////////////////////
Route::get('/{vue_capture?}', function () {
    return view('cliente');
})->where('vue_capture', '[\/\w\.-]*');
///////////////////////////////----FIN-RUTAS--CLIENTE---//////////////////////



