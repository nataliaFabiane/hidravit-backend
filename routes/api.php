<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;

Route::get('/pacientes', [PacienteController::class, 'index']);

Route::post('/pacientes', [PacienteController::class, 'store']);

Route::get('/pacientes/{numero}', [PacienteController::class, 'show']);