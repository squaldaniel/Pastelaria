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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('email', 80)->unique();
            $table->string('telefone', 15);
            $table->date('nascimento');
            $table->string('endereco');
            $table->string('complemento', 100);
            $table->string('bairro', 60);
            $table->string('cep', 8);
            $table->timestamp('cadastro')->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
