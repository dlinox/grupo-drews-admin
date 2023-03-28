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
        Schema::create('iconos_fas', function (Blueprint $table) {
            $table->id();
            $table->string('class', 60);
            $table->string('name', 50);
            $table->char('version',8)->default('5.0.9');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iconos_fas');
    }
};
