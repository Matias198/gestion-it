<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComponentesController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\SolicitudController;
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

Route::get('/', [AuthController::class, 'index'])->name('auth.login');
Route::get('/welcome', [Controller::class, 'index'])->name('layouts.welcome');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class)->middleware('role:Administrador|Usuarios del Área de Sistemas');
    Route::resource('roles', RoleController::class)->middleware('role:Administrador');
    Route::resource('equipos', EquipoController::class)->middleware('role:Administrador|Usuarios del Área de Sistemas|Usuario Comun');
    Route::resource('categorias', CategoriaController::class)->middleware('role:Administrador|Usuarios del Área de Sistemas');
    Route::resource('componentes', ComponentesController::class)->middleware('role:Administrador|Usuarios del Área de Sistemas');
    Route::resource('solicitud', SolicitudController::class)->middleware('role:Administrador|Usuarios del Área de Sistemas|Usuario Comun');
})
;
Route::get('auth/login', [AuthController::class, 'index'])->name('auth.login');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('auth/register', [AuthController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register.submit');

