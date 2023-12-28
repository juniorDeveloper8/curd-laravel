<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpleadoController; // llamando a mis funciones del controlador
use App\Http\Livewire\EmployeeComponent;// llamando a mis funciones del componente
use Livewire\Livewire;

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

/** mis rutas */

Route::get('/empleado', function () {
    return view('empleado.index');
});

//Route::get('empleado/create', [EmpleadoController::class,'create']);// mostramos lo q tenga el controlador

//automaticaion de todos lo metodos de mi clase

Route::resource('empleado', EmpleadoController::class);// con esta intrucion se puede aceder a todos mi funciones y ahorramos codigo
