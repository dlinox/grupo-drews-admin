<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\ReservaController;
use App\Http\Controllers\Admin\ServicioController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\WebController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\CategoriasController;
use App\Http\Controllers\Admin\ClientesController;
use App\Http\Controllers\Admin\SedesController;
use App\Http\Controllers\Web\WebController as WebWebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::get('/user-auth', function () {
    $user = Auth::user();
    if (!$user) {
        return response()->json(false);
    }
    return response()->json(true);
});


Route::name('auth.')->prefix('auth')->group(function () {

    Route::get('', [AuthController::class, 'login'])
        ->name('login');

    Route::post('sign-in', [AuthController::class, 'signIn'])
        ->name('sign-in');

    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');
});


Route::name('web.')->group(function () {
    //PAGES ****************
    Route::get('', [WebWebController::class, 'pageInicio'])->name('inicio');

    Route::get('vehiculos', [WebWebController::class, 'pageVehiculos'])->name('vehiculos');
    Route::get('nosotros', [WebWebController::class, 'pageNosotros'])->name('nosotros');
    Route::get('servicios', [WebWebController::class, 'pageServicios'])->name('servicios');
    Route::get('servicios/{id}', [WebWebController::class, 'pageServicioDetalle'])->name('servicios-detalle');
    Route::get('contactanos', [WebWebController::class, 'pageContactanos'])->name('contactanos');

    //PAGES ****************

    Route::post('sign-in', [AuthController::class, 'signIn'])
        ->name('sign-in');

    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');
});




Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::get('', [AdminController::class, 'index'])
        ->name('index');

    Route::resource('usuarios', UsuarioController::class);
    Route::resource('servicios', ServicioController::class);
    Route::resource('productos', ProductoController::class); // VEHICULOS TEMPORAL
    Route::resource('categorias', CategoriasController::class);

    Route::resource('clientes', ClientesController::class);

    Route::resource('sedes', SedesController::class);

    Route::resource('configuraciones', WebController::class);
    Route::post('configuraciones/update-logo', [WebController::class, 'updateLogo']);

    Route::controller(ReservaController::class)->name('reservas.')->prefix('reservas')->group(function () {
        Route::get('', 'index')->name('index');
    });


    Route::controller(WebController::class)->name('web.')->prefix('web')->group(function () {
        Route::get('', 'index')->name('index');
    });

    //Route::resource('oficinas', OficinaController::class);

});
