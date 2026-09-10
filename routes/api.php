<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\SoroController;
use App\Http\Controllers\LeituraSoroController;
use App\Http\Controllers\AlertaController;

Route::get('/pacientes', [PacienteController::class, 'index']);

Route::post('/pacientes', [PacienteController::class, 'store']);

Route::get('/pacientes/{numero}', [PacienteController::class, 'show']);

Route::get('/soros', [SoroController::class, 'index']);

Route::post('/soros', [SoroController::class, 'store']);

Route::get('/soros/{id}', [SoroController::class, 'show']);

Route::get('/leituras', [LeituraSoroController::class, 'index']);

Route::post('/leituras', [LeituraSoroController::class, 'store']);

Route::get('/leituras/{id}', [LeituraSoroController::class, 'show']);

Route::get('/alertas', [AlertaController::class, 'index']);

Route::get('/alertas/{id}', [AlertaController::class, 'show']);