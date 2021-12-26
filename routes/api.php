<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('marca',App\Http\Controllers\MarcaController::class)->only([
    'index','store','update','show','destroy'
]);
Route::resource('categoria',App\Http\Controllers\CategoriaController::class,
    ['parameters' => 'singular'])->parameters(['categoria' => 'categoria','categorium' => 'categoria'])->only([
    'index','store','update','show','destroy'
]);
Route::resource('unidad',App\Http\Controllers\UnidadController::class)->only([
    'index','store','update','show','destroy'
]);
Route::resource('cliente',App\Http\Controllers\ClienteController::class)->only([
    'index','store','update','show','destroy'
]);
Route::resource('proveedor',App\Http\Controllers\ProveedorController::class)->only([
    'index','store','update','show','destroy'
]);
Route::resource('empresa',App\Http\Controllers\EmpresaController::class)->only([
    'index','store','update','show','destroy'
]);
Route::resource('producto',App\Http\Controllers\ProductoController::class)->only([
    'index','store','update','show','destroy'
]);
Route::resource('compra',App\Http\Controllers\CompraController::class)->only([
    'index','store','update','show','destroy'
]);
