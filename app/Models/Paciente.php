<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';

    protected $fillable = [
        'numero_paciente',
        'nome',
        'data_nascimento',
        'observacoes',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];
}