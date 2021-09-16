<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombreProducto');
            $table->integer('cantidad');
            $table->float('precio');
            $table->timestamps();
        });

        DB::table('productos')->insert([
            ['nombreProducto' => 'Zapato', 'cantidad' => '0', 'precio' => '20000'],
            ['nombreProducto' => 'Camisa', 'cantidad' => '0', 'precio' => '30000'],
            ['nombreProducto' => 'Pantalon', 'cantidad' => '0', 'precio' => '50000'],
            ['nombreProducto' => 'Camisilla', 'cantidad' => '0', 'precio' => '20000'],
            ['nombreProducto' => 'Gorra', 'cantidad' => '0', 'precio' => '25000'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
