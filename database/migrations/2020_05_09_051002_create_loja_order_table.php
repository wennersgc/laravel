<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojaOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loja_order', function (Blueprint $table) {
            $table->unsignedBigInteger('loja_id');
            $table->unsignedBigInteger('order_id');
            $table->timestamps();

            $table->foreign('loja_id')->references('id')->on('lojas');
            $table->foreign('order_id')->references('id')->on('user_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loja_order');
    }
}
