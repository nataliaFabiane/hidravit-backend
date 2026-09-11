<?php

namespace App\Http\Controllers;

use App\Models\LeituraSoro;
use App\Models\Alerta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeituraSoroController extends Controller
{
    public function index()
    {
        return response()->json(
            LeituraSoro::with('soro')->get()
        );
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'soro_id' => 'required|exists:soros,id',
            'peso_atual' => 'required|numeric|min:0',
            'data_hora' => 'required|date',
        ]);

        $leitura = LeituraSoro::create($dados);

        $soro = $leitura->soro;

        $pesoLiquidoInicial = $soro->peso_inicial - $soro->peso_frasco;
        $pesoLiquidoAtual = $leitura->peso_atual - $soro->peso_frasco;

        $percentual = ($pesoLiquidoAtual / $pesoLiquidoInicial) * 100;

        $percentual = max(0, min(100, $percentual));

        $tipoAlerta = null;

        if ($percentual <= 5) {
            $tipoAlerta = 'FINAL';
        } elseif ($percentual <= 20) {
            $tipoAlerta = '20%';
        } elseif ($percentual <= 50) {
            $tipoAlerta = '50%';
        }

        $mensagemAlerta = null;

        if ($tipoAlerta === '50%') {
            $mensagemAlerta = 'Soro em 50%';
        } elseif ($tipoAlerta === '20%') {
            $mensagemAlerta = 'Atenção, soro em 20%';
        } elseif ($tipoAlerta === 'FINAL') {
            $mensagemAlerta = 'Soro acabando';
        }

        if ($tipoAlerta) {
            $jaExiste = Alerta::where('soro_id', $soro->id)
                ->where('tipo', $tipoAlerta)
                ->exists();

            if (!$jaExiste) {
                Alerta::create([
                    'soro_id' => $soro->id,
                    'leitura_soro_id' => $leitura->id,
                    'tipo' => $tipoAlerta,
                    'percentual' => round($percentual, 2),
                    'data_hora' => $leitura->data_hora,
                ]);
            }
        }

        return response()->json([
            'id' => $leitura->id,
            'soro_id' => $leitura->soro_id,
            'peso_atual' => $leitura->peso_atual,
            'data_hora' => $leitura->data_hora,
            'percentual_restante' => round($percentual, 2),
            'alerta' => $tipoAlerta,
            'mensagem' => $mensagemAlerta,
        ], 201);
    }

    public function show($id)
    {
        $leitura = LeituraSoro::with('soro')->find($id);

        if (!$leitura) {
            return response()->json([
                'message' => 'Leitura não encontrada.'
            ], 404);
        }

        return response()->json($leitura);
    }
}
