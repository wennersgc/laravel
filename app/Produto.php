<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Produto extends Model
{
    use HasSlug;

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

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nome')
            ->saveSlugsTo('slug');
    }
}
