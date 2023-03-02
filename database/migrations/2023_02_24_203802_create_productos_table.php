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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('detalle');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('categoria')->nullable();
            $table->string('tipo')->nullable();
            $table->string('combustible')->nullable();
            $table->string('cilindrada')->nullable();
            $table->integer('puertas')->nullable();
            $table->integer('capacidad')->nullable();
            $table->boolean('aire_acondicionado')->default(0);
            $table->integer('equipaje')->nullable();
            $table->string('imagenes')->nullable();
            $table->string('contenido')->nullable();
            $table->double('precio', 7, 2)->default(0.00);
            $table->string('precio_oferta', 7, 2)->default(0.00);
            $table->char('disponible')->default('D'); //D : disponible S:servservado  U: usando
            $table->string('descripcion')->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
