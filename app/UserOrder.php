<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $fillable = ['reference', 'pagseguro_status', 'pagseguro_code', 'loja_id', 'itens'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loja()
    {
        return $this->belongsTo(Loja::class);
    }

    public function lojas()
    {
        return $this->belongsToMany(Loja::class, 'loja_order', 'order_id');
    }
}
