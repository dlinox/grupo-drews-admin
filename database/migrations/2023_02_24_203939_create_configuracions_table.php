<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configuracions', function (Blueprint $table) {
            $table->id();
            $table->string('web_logo', 100)->default(url('/assets/image/logo.png'));
            $table->string('web_url', 100)->default('https://www.grupodrews.com.pe');
            $table->string('web_nombre', 100)->default('Grupo Drews');
            $table->text('web_descripcion', 500)->nullable();
            $table->string('web_telefonos', 50)->default('51-326149');
            $table->string('web_celulares', 100)->default('989124060');
            $table->string('web_direcciones', 200)->default('https://www.grupodrews.com.pe');
            $table->string('web_whatsapp', 15)->default('989124060');
            $table->string('web_correo', 50)->default('informes@grupodrews.com.pe');
            $table->text('web_mision', 500)->nullable();
            $table->text('web_vision', 500)->nullable();
            $table->string('web_social_facebook', 150)->nullable();
            $table->string('web_social_instagram', 150)->nullable();
            $table->string('web_social_youtube', 150)->nullable();
            $table->string('web_social_twitter', 150)->nullable();
            $table->string('web_update')->default(Uuid::uuid4());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracions');
    }
};
