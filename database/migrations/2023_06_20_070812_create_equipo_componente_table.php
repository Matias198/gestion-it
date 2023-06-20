<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoComponenteTable extends Migration
{
    public function up()
    {
        Schema::create('equipo_componente', function (Blueprint $table) {
            $table->unsignedBigInteger('equipo_id');
            $table->unsignedBigInteger('componentes_id');
            $table->timestamps();

            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreign('componentes_id')->references('id')->on('componentes')->onDelete('cascade');
            
            $table->primary(['equipo_id', 'componentes_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipo_componente');
    }
}
