<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartController;
use App\Http\Controllers\UserController;

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

/* Route::get('/', function () {
    return view('components.layout');
}); */

Route::get('/', [DepartController::class, 'index']);//Retorna vista principal
//Cuando pulsa el botón editar llama a este controlador el cual comprueba si existe el id y retorna la vista departedit.blade pasandole la fila correspondiente a ese id y en el value con el old mostramos el valor
Route::get('/depart/{id}/edit', [DepartController::class, 'edit']);
Route::put('/depart/{id}/update', [DepartController::class, 'update'])->name('depart.update');
Route::delete('/depart/{id}/destroy', [DepartController::class, 'destroy']);
Route::post('/depart/insertar', [DepartController::class, 'create']);

//Cuando pulso el botón de login de la página principal
Route::get('/login', [UserController::class, 'formlogin']);
Route::post('/login', [UserController::class, 'login']);
//Botón logout página principal
Route::get('/logout', [UserController::class, 'logout']);
