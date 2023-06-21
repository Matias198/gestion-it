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
        Schema::create('solicitud_equipos', function (Blueprint $table) {
            $table->unsignedBigInteger('solicitud_id');
            $table->unsignedBigInteger('equipo_id');
            $table->timestamps();

            $table->foreign('solicitud_id')->references('id')->on('solicitud')->onDelete('cascade');
            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade');

            $table->primary(['solicitud_id', 'equipo_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_equipos');
    }
};
