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
            $table->longText('informacoes');
            $table->decimal('preco', 10, 2);
            $table->string('slug');
            $table->timestamps();

<<<<<<< HEAD
<<<<<<< HEAD
            $table->foreign('loja_id')->references('id')->on('loja');
=======
            $table->foreign('loja_id')->references('id')->on('lojas');
>>>>>>> # Foram criados os models Loja e Produto
=======
            $table->foreign('loja_id')->references('id')->on('lojas');
>>>>>>> 18192dbb5262a5a8b277ee09ad65bcbccd94510d
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
