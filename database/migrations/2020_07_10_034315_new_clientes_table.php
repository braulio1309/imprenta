<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_doc');
            $table->string('numero_doc');
            $table->string('name');
            $table->string('email');
            $table->string('telefono');
            $table->string('provincia');
            $table->string('estado')->nullable();
            $table->string('localidad')->nullable();
            $table->string('postal')->nullable();
            $table->string('domicilio')->nullable();
            $table->string('numero')->nullable();
            $table->string('departamento')->nullable();
            $table->string('piso')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
