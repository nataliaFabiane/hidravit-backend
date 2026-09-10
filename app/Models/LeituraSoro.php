<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soro;
use App\Models\Alerta;

class LeituraSoro extends Model
{
    protected $table = 'leitura_soros';

    protected $fillable = [
        'soro_id',
        'peso_atual',
        'data_hora',
    ];

    protected $casts = [
        'peso_atual' => 'decimal:2',
        'data_hora' => 'datetime',
    ];

    public function soro()
    {
        return $this->belongsTo(Soro::class);
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class, 'leitura_soro_id');
    }
}