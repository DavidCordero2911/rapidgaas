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
        Schema::table('mensajes_chat', function (Blueprint $table) {
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->nullOnDelete();
            $table->boolean('es_bot')->default(false);
            $table->boolean('es_admin')->default(false);
            $table->boolean('leido_admin')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('mensajes_chat', function (Blueprint $table) {
            $table->dropColumn(['cliente_id', 'es_bot', 'es_admin', 'leido_admin']);
        });
    }
};
