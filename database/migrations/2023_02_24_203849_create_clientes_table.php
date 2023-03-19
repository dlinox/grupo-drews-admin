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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('r_social', 150);
            $table->char('num_doc', 15)->nullable();
            $table->string('tipo_doc', 30)->nullable();
            $table->string('logo')->nullable();
            $table->string('nombre', 50)->nullable();
            $table->string('apellidos', 150)->nullable();
            $table->char('correo', 80)->nullable();
            $table->char('celular', 15)->nullable();
            $table->boolean('publico')->default(1);
            $table->string('web', 180)->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
