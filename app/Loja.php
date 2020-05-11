<?php

namespace App;

use App\Notifications\LojaRecebeuNovoPedido;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Loja extends Model
{
    use HasSlug;

    protected $fillable = ['nome', 'descricao', 'fone', 'celular', 'slug', 'logo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nome')
            ->saveSlugsTo('slug');
    }

    public function orders()
    {
        return $this->belongsToMany(UserOrder::class, 'loja_order', 'loja_id', 'order_id');
    }

    public function notificaDonosDeLoja($lojasId)
    {
        $lojas = $this->whereIn('id', $lojasId)->get();

        $lojas->map(function ($loja){
            return $loja->user;
        })->each->notify(new LojaRecebeuNovoPedido());
    }

}
