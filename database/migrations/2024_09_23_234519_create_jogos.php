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
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->integer('placar_casa')->nullable();
            $table->integer('placar_visitante')->nullable();
            $table->timestamp('data_hora_jogo')->nullable();
            $table->integer('time_casa_id');
            $table->integer('time_visitante_id');
            $table->foreign('time_casa_id')->references('id')->on('times');
            $table->foreign('time_visitante_id')->references('id')->on('times');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jogos');
    }
};
