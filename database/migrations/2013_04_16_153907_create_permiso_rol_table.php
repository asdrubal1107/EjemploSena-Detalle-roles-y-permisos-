<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePermisoRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permiso_rol', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idRol')->references('id')->on('roles')->onUpdate('cascade');
            $table->foreignId('idPermiso')->references('id')->on('permisos')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('permiso_rol')->insert([
            ['idRol' => '1', 'idPermiso' => '1'],
            ['idRol' => '1', 'idPermiso' => '2'],
            ['idRol' => '1', 'idPermiso' => '3'],
            ['idRol' => '1', 'idPermiso' => '4'],
            ['idRol' => '2', 'idPermiso' => '1'],
            ['idRol' => '2', 'idPermiso' => '2']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permiso_rol');
    }
}
