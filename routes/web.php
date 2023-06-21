<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComponentesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\SolicitudesController;
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

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class); 
    Route::resource('roles', RoleController::class);
    Route::resource('solicitudes', SolicitudesController::class); 
    Route::resource('equipos', EquipoController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('componentes', ComponentesController::class);
})
;
Route::get('auth/login', [AuthController::class, 'index'])->name('auth.login');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('auth/register', [AuthController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register.submit');

