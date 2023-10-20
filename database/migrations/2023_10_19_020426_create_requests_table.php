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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cod_client')->unsigned();
            $table->foreign('cod_client')->references('id')->on('clients');
            $table->bigInteger('cod_produt')->unsigned();
            $table->foreign('cod_produt')->references('id')->on('products');
            $table->double('total', 8,2);
            $table->timestamp('dt_request')->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
