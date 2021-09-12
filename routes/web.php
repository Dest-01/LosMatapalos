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

/////Rutas protegidas
Route::get('/dashboard', function () {
    return view('admin');
})->where('dashboard', '[\/\w\.-]*')->middleware('auth');

Route::get('/products', function () {
    return view('admin');
})->where('products', '[\/\w\.-]*')->middleware('auth');

Route::get('/product/test', function () {
    return view('admin');
})->where('product/test', '[\/\w\.-]*')->middleware('auth');


//RUTA CRUDS ADMIN PROTEGIDO

Route::get('/admin/personas', function () {
    return view('admin');
})->where('admin/personas', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/organizaciones', function () {
    return view('admin');
})->where('admin/organizaciones', '[\/\w\.-]*')->middleware('auth');


Route::get('/admin/donativos', function () {
    return view('admin');
})->where('admin/donativos', '[\/\w\.-]*')->middleware('auth');

Route::get('/admin/Catdonativos', function () {
    return view('admin');
})->where('admin/Catdonativos', '[\/\w\.-]*')->middleware('auth');


///Para rutas que no este protegidas
Route::get('/{vue_capture?}', function () {
    return view('cliente');
})->where('vue_capture', '[\/\w\.-]*');




