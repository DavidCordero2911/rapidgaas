<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ordenes_trabajo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->foreignId('mecanico_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('estado', [
                'en_espera',
                'en_diagnostico',
                'en_reparacion',
                'finalizado',
                'entregado'
            ])->default('en_espera');
            $table->text('diagnostico_inicial')->nullable();
            $table->text('observaciones')->nullable();
            $table->decimal('presupuesto_estimado', 8, 2)->nullable();
            $table->decimal('coste_final', 8, 2)->nullable();
            $table->datetime('fecha_entrada')->useCurrent();
            $table->datetime('fecha_estimada')->nullable();
            $table->datetime('fecha_entrega')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_trabajo');
    }
};
