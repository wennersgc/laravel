<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'informacoes', 'preco', 'slug'];

    public function loja()
    {
        return $this->belongsTo(Loja::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }


    public function fotos()
    {
        return $this->hasMany(ProdutosFotos::class);
    }
}
