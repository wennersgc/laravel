<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        return view('cart', compact('cart'));

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
            session()->put('cart', $produtos);
        }

        flash('Produto adicionado ao carrinho')->success();
        return redirect()->route('produto.single',['slug' => $produto['slug']]);
    }
}
