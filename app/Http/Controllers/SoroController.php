<?php

namespace App\Http\Controllers;

use App\Models\Soro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SoroController extends Controller
{
    public function index()
    {
        return response()->json(
            Soro::with('paciente')->get()
        );
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'tipo_soro' => 'required|string|max:255',
            'volume' => 'required|numeric|min:0',
            'peso_inicial' => 'required|numeric|min:0',
            'horario_inicio' => 'required|date',
            'status' => 'nullable|string|max:255',
            'gotejamento' => 'nullable|numeric|min:0',
        ]);

        $soro = Soro::create($dados);

        return response()->json($soro, 201);
    }

    public function show($id)
    {
        $soro = Soro::with('paciente')->find($id);

        if (!$soro) {
            return response()->json([
                'message' => 'Soro não encontrado.'
            ], 404);
        }

        return response()->json($soro);
    }
}