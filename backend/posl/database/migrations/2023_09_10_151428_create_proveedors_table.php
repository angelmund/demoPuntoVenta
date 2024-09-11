<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('nif')->nullable();
            $table->string('direccion')->nullable();
            $table->unsignedBigInteger('contacto')->nullable()->digits(12);
            $table->foreignId('marca_id')->nullable()->constrained('marcas');
            $table->foreignId('articulo_id')->nullable()->constrained('articulos');
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
        Schema::dropIfExists('proveedors');
    }
};
