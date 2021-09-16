<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntradaController;
use App\Models\Entrada;

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

Route::get('/', function () {
    return redirect('/compras');
});

Auth::routes();

Route::middleware(['ValidarPermisos'])->group(function () {
    Route::get('/compras', [EntradaController::class, 'index']);
    Route::get('/compras/listar', [EntradaController::class, 'getCompras']);
    Route::get('/compras/crear', [EntradaController::class, 'create'])->name('crearCompra');
    Route::post('/compras/guardar/compra', [EntradaController::class, 'save'])->name('guardarCompra');
    Route::get('/compras/ver/{id}', [EntradaController::class, 'indexEntradas']);
    Route::get('/compras/entradas/listar/{id}', [EntradaController::class, 'getEntradas']);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
