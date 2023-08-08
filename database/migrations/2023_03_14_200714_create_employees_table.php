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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('Serial', 150);
            $table->string('Modelo', 255);
            $table->string('Estado', 255);
            $table->date('fechaFabricacion');
            $table->string('tipoAsistencia', 255);
            $table->date('fechaInstalacion');
            $table->string('tipoMantenimiento', 255);
            $table->date('fechaMantenimiento');
            $table->string('tipoPieza', 255);
            $table->date('fechaCambioPieza');
            // Cambio de tipo de dato y eliminación de autoincremento
            $table->integer('numeroCiclos')->unsigned(); 
            $table->date('fechaIncidente');
            $table->string('Observaciones', 255);
            $table->string('Img');

            $table->foreignId('department_id')
                ->constrained('departments')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
