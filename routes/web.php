<?php

use App\Http\Controllers\TorneoController;
use App\Http\Controllers\PartidoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// Rutas públicas
Route::get('/clasificacion', [TorneoController::class, 'clasificacion'])->name('clasificacion');
Route::get('/enfrentamientos', [PartidoController::class, 'enfrentamientos'])->name('enfrentamientos');

// Rutas protegidas por sesión admin
Route::post('/generar-enfrentamientos', [TorneoController::class, 'generarEnfrentamientos'])->name('generar.enfrentamientos');
Route::post('/partido/{partido}/registrar-ganador', [PartidoController::class, 'registrarGanador'])->name('partido.registrar.ganador');
Route::post('/partido/{partido}/reiniciar', [PartidoController::class, 'reiniciarPartido'])->name('partido.reiniciar');
