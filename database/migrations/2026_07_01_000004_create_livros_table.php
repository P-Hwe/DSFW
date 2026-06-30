<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('isbn')->unique()->nullable();
            $table->year('ano_publicacao')->nullable();
            $table->unsignedSmallInteger('quantidade_total')->default(1);
            $table->unsignedSmallInteger('quantidade_disponivel')->default(1);
            $table->foreignId('autor_id')->constrained('autores')->cascadeOnDelete();
            $table->foreignId('categoria_id')->constrained('categorias')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
