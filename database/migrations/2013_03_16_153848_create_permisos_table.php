<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('url');
            $table->string('metodo');
            $table->boolean('identico');
            $table->timestamps();
        });

        DB::table('permisos')->insert([
            ['nombre' => 'Listar compras', 'url' => '/compras', 'metodo' => 'GET', 'identico' => '1'],
            ['nombre' => 'Listar entradas', 'url' => '/compras/ver/', 'metodo' => 'GET', 'identico' => '0'],
            ['nombre' => 'Ver formulario crear compras', 'url' => '/compras/crear', 'metodo' => 'GET', 'identico' => '1'],
            ['nombre' => 'Guardar compra', 'url' => '/compras/guardar/compra', 'metodo' => 'POST', 'identico' => '1']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}
