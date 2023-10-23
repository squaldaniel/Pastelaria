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
        Schema::defaultStringLength(191);
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cod_client')->unsigned();
            $table->foreign('cod_client')->references('id')->on('clients');
            $table->double('total', 8,2)->nullable();
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
