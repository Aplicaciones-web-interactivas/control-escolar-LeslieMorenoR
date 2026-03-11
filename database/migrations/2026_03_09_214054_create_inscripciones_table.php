<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('inscripciones', function (Blueprint $table) {
        $table->id();
        $table->foreignId('grupo_id')->constrained('grupos')->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();

        $table->unique(['grupo_id', 'user_id']);
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};