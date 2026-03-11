<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('horarios', function (Blueprint $table) {
        $table->id();
        $table->foreignId('materia_id')->constrained('materias')->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->time('hora_inicio');
        $table->time('hora_fin');
        $table->string('dias'); // Ej: "L,Mi,V"
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};