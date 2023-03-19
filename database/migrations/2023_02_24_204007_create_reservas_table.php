<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id(); 
            $table->enum('tipo', ['Servicio','Vehiculo']);
            $table->date('fecha_ini')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('sede')->nullable();
            $table->bigInteger('producto');
            $table->bigInteger('cliente'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
