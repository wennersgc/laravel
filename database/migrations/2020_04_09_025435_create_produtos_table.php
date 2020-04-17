<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('loja_id');

            $table->string('nome');
            $table->string('descricao');
            $table->string('informcaoes');
            $table->decimal('preco', 10, 2);
            $table->string('slug');
            $table->timestamps();

            $table->foreign('loja_id')->references('id')->on('loja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
