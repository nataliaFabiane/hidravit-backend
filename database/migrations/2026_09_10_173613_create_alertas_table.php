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
        Schema::create('alertas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('soro_id')
                ->constrained('soros')
                ->cascadeOnDelete();

            $table->foreignId('leitura_soro_id')
                ->constrained('leitura_soros')
                ->cascadeOnDelete();

            $table->string('tipo');

            $table->decimal('percentual', 5, 2);

            $table->dateTime('data_hora');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertas');
    }
};
