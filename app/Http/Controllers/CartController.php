<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        dd(session()->get('cart'));
    }

    public function add(Request $request)
    {
        $produto = $request->get('produto');

        //existe sessao para os produtos?
        if (session()->has('cart')) {
            //sim: atualizar os produtos na sessão existente
            session()->push('cart', $produto);

        } else {
            //não: criar sessão com o primeiro produto
            $produtos[] = $produto;
            session()->push('cart', $produtos);
        }

        flash('Produto adiconado ao carrinho')->success();
        return redirect()->route('produto.single',['slug' => $produto['slug']]);
    }
}
