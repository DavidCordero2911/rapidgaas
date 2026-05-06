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
    Schema::create('registros_reparacion', function (Blueprint $table) {
        $table->id();
        $table->foreignId('orden_id')->constrained('ordenes_trabajo')->onDelete('cascade');
        $table->foreignId('mecanico_id')->constrained('users')->onDelete('cascade');

        // Checkboxes de revisión
        $table->boolean('diagnostico_inicial')->default(false);
        $table->boolean('revision_neumaticos')->default(false);
        $table->boolean('revision_motor')->default(false);
        $table->boolean('revision_frenos')->default(false);
        $table->boolean('revision_presion')->default(false);
        $table->boolean('revision_aceite')->default(false);
        $table->boolean('revision_cadena')->default(false);
        $table->boolean('revision_electrica')->default(false);
        $table->boolean('revision_suspension')->default(false);
        $table->boolean('revision_filtros')->default(false);

        // Notas adicionales
        $table->text('observaciones_reparacion')->nullable();
        $table->text('piezas_sustituidas')->nullable();

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('registros_reparacion');
}
};
