<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;
use App\Models\LeituraSoro;
use App\Models\Alerta;

class Soro extends Model
{
    protected $table = 'soros';

    protected $fillable = [
        'paciente_id',
        'tipo_soro',
        'volume',
        'peso_inicial',
        'peso_frasco',
        'horario_inicio',
        'status',
        'gotejamento',
    ];

    protected $casts = [
        'horario_inicio' => 'datetime',
        'volume' => 'decimal:2',
        'peso_inicial' => 'decimal:2',
        'peso_frasco' => 'decimal:2',
        'gotejamento' => 'decimal:2',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function leituras()
    {
        return $this->hasMany(LeituraSoro::class);
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class);
    }
}
