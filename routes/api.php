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

//Grupo de rutas para los controladores en la carpeta API V1
Route::namespace('App\\Http\\Controllers\\API\V1')->group(function () {
    Route::get('profile', 'ProfileController@profile');
    Route::put('profile', 'ProfileController@updateProfile');
    Route::post('change-password', 'ProfileController@changePassword');
    Route::get('tag/list', 'TagController@list');
    Route::get('category/list', 'CategoryController@list');
    Route::post('product/upload', 'ProductController@upload');

///////Rutas Personalizadas o especificas a un metodo
    Route::get('persona/lista', 'PersonasController@list');
    Route::get('reservarCliente/verificar', 'PersonasController@obtenerCedula');
    Route::get('organizacion/lista', 'OrganizacionesController@list');

    //////Rutas total GET, PUT, POST, DELETE
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
    ]);
});

Route::namespace('App\\Http\\Controllers\\API\client')->group(function () {
        
   // Route::get('reservarCliente/verificar', 'ReservarCliController@obtenerCedula');

    Route::apiResources([
        'reservarCliente' => 'ReservarCliController',
    ]);
});