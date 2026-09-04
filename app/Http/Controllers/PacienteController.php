<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        return response()->json(Paciente::all());
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'numero_paciente' => 'required|string|unique:pacientes,numero_paciente',
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
            'observacoes' => 'nullable|string',
        ]);

        $paciente = Paciente::create($dados);

        return response()->json($paciente, 201);
    }

    public function show($numero)
    {
        $paciente = Paciente::where('numero_paciente', $numero)->first();

        if (!$paciente) {
            return response()->json([
                'message' => 'Paciente não encontrado.'
            ], 404);
        }

        return response()->json($paciente);
    }
}