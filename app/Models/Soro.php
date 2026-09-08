<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;

class Soro extends Model
{
    protected $table = 'soros';

    protected $fillable = [
        'paciente_id',
        'tipo_soro',
        'volume',
        'peso_inicial',
        'horario_inicio',
        'status',
        'gotejamento',
    ];

    protected $casts = [
        'horario_inicio' => 'datetime',
        'volume' => 'decimal:2',
        'peso_inicial' => 'decimal:2',
        'gotejamento' => 'decimal:2',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}