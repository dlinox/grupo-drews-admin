<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\ReservaController;
use App\Http\Controllers\Admin\ServicioController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\WebController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Home');
});


Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('', [AdminController::class, 'index'])
        ->name('index');

    Route::resource('usuarios', UsuarioController::class);

    Route::resource('servicios', ServicioController::class);

    Route::resource('productos', ProductoController::class);

    Route::controller(ReservaController::class)->name('reservas.')->prefix('reservas')->group(function () {
        Route::get('', 'index')->name('index');
    });


    Route::controller(WebController::class)->name('web.')->prefix('web')->group(function () {
        Route::get('', 'index')->name('index');
    });

    //Route::resource('oficinas', OficinaController::class);

});
