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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('Serial', 255);
            $table->string('Pais', 255);
            $table->string('Ciudad', 255);
            $table->string('Institucion', 255);
            $table->string('Telefono', 20);
            $table->string('Direccion', 255);
            $table->string('ubicacionEquipo', 255);
            $table->integer('Piso')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};