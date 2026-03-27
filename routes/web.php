<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\TareaController;

// Rutas públicas
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('materias', MateriaController::class);
    Route::resource('horarios', HorarioController::class);
    
    Route::resource('grupos', GrupoController::class);

    Route::resource('inscripciones', InscripcionController::class)->only(['index', 'store', 'destroy']);
    Route::resource('calificaciones', CalificacionController::class)->only(['index', 'show', 'store']);
    Route::get('mis-calificaciones', [CalificacionController::class, 'misCalificaciones'])->name('calificaciones.mias');
    Route::resource('tareas', TareaController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
    Route::get('mis-tareas', [TareaController::class, 'misTareas'])->name('tareas.mias');
    Route::post('entregas', [TareaController::class, 'entregar'])->name('entregas.store');
});