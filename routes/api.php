<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\SoroController;

Route::get('/pacientes', [PacienteController::class, 'index']);

Route::post('/pacientes', [PacienteController::class, 'store']);

Route::get('/pacientes/{numero}', [PacienteController::class, 'show']);

Route::get('/soros', [SoroController::class, 'index']);

Route::post('/soros', [SoroController::class, 'store']);

Route::get('/soros/{id}', [SoroController::class, 'show']);