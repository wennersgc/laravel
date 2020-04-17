<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable= ['nome', 'descricao', 'slug'];

    public function produto()
    {
        return $this->belongsToMany(Produto::class);
    }
}
