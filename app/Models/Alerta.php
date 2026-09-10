<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $table = 'alertas';

    protected $fillable = [
        'soro_id',
        'leitura_soro_id',
        'tipo',
        'percentual',
        'data_hora',
    ];

    protected $casts = [
        'percentual' => 'decimal:2',
        'data_hora' => 'datetime',
    ];

    public function soro()
    {
        return $this->belongsTo(Soro::class);
    }

    public function leitura()
    {
        return $this->belongsTo(LeituraSoro::class, 'leitura_soro_id');
    }
}