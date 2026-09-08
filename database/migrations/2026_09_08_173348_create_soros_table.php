<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('soros', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paciente_id')
                ->constrained('pacientes')
                ->cascadeOnDelete();

            $table->string('tipo_soro');
            $table->decimal('volume', 6, 2);
            $table->decimal('peso_inicial', 6, 2);
            $table->dateTime('horario_inicio');
            $table->string('status')->default('Em andamento');
            $table->decimal('gotejamento', 6, 2)->nullable();

            $table->timestamps();
        });
    }
};