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
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->boolean('status')->default(false); // status como booleano (em andamento ou concluído)
            $table->foreignId('projeto_id')->constrained('projetos')->onDelete('cascade'); // Relacionamento com projeto
            $table->foreignId('admin_id')->constrained('users'); // Relacionamento com admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
