<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutosFotos extends Model
{
    protected $fillable = ['image'];
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
