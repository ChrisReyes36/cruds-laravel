<?php

use App\Http\Controllers\Agencia\AgenciaController;
use App\Http\Controllers\Departamento\DepartamentoController;
use App\Models\Departamento\Departamento;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// Rutas de Agencia
Route::get('/agencias', [AgenciaController::class, 'index']);
Route::get('/agencias/listar', [AgenciaController::class, 'list']);
Route::post('/agencias', [AgenciaController::class, 'store']);
Route::get('/agencias/{id_agencia}', [AgenciaController::class, 'show']);
Route::put('/agencias/{id_agencia}', [AgenciaController::class, 'update']);
Route::delete('/agencias/{id_agencia}', [AgenciaController::class, 'destroy']);

// Rutas de Departamento
Route::get('/departamentos', [DepartamentoController::class, 'index']);
Route::get('/departamentos/listar', [DepartamentoController::class, 'list']);
Route::post('/departamentos', [DepartamentoController::class, 'store']);
Route::get('/departamentos/{id_departamento}', [DepartamentoController::class, 'show']);
Route::put('/departamentos/{id_departamento}', [DepartamentoController::class, 'update']);
Route::delete('/departamentos/{id_departamento}', [DepartamentoController::class, 'destroy']);