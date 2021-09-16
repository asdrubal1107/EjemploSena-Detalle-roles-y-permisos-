<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('nombreModulo');
            $table->string('url');
            $table->string('icono');
            $table->string('padre');
            $table->timestamps();
        });

        DB::table('menu')->insert([
            ['nombreModulo' => 'compras', 'url' => '/compras', 'icono' => 'C', 'padre' => "NO"],
            ['nombreModulo' => 'Padre', 'url' => '#', 'icono' => 'P', 'padre' => "SI"],
            ['nombreModulo' => 'Hijo 1', 'url' => '#', 'icono' => 'H1', 'padre' => "2"],
            ['nombreModulo' => 'Hijo 2', 'url' => '#', 'icono' => 'H2', 'padre' => "2"],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
