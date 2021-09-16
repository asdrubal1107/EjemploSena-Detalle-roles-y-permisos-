<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMenuRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_rol', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idRol')->references('id')->on('roles')->onUpdate('cascade');
            $table->foreignId('idMenu')->references('id')->on('menu')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('menu_rol')->insert([
            ['idRol' => '1', 'idMenu' => '1'],
            ['idRol' => '1', 'idMenu' => '2'],
            ['idRol' => '1', 'idMenu' => '3'],
            ['idRol' => '1', 'idMenu' => '4'],
            ['idRol' => '2', 'idMenu' => '1'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_rol');
    }
}
