<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    public function index()
    {
        return response()->json(
            Alerta::with(['soro', 'leitura'])->get()
        );
    }

    public function show($id)
    {
        $alerta = Alerta::with(['soro', 'leitura'])->find($id);

        if (!$alerta) {
            return response()->json([
                'message' => 'Alerta não encontrado.'
            ], 404);
        }

        return response()->json($alerta);
    }
}