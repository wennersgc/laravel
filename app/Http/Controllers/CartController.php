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
        $produtoData = $request->get('produto');

        $produto = \App\Produto::whereSlug($produtoData['slug']);

        if (!$produto->count() || $produtoData['quantidade'] <= 0) {
            flash('Produto não encontrado ou quantidade minima não informada')->warning();
            return redirect()->route('home');
        }

        $produto = $produto->first(['nome','preco'])->toArray();
        $produto = array_merge($produtoData, $produto);

        //existe sessao para os produtos?
        if (session()->has('cart')) {

            $produtos = session()->get('cart');
//            dd($produtos);
            $produtosSlugs = array_column($produtos, 'slug');

            //evitando duplicidades
            //se o slug já existir, se a sessão já tiver um produto com o mesmo slug de $produtosSlugs
            if (in_array($produto['slug'], $produtosSlugs)) {
                $produtos = $this->incrementaProduto($produto['slug'], $produto['quantidade'], $produtos);
                session()->put('cart', $produtos);

                //se não tiver duplicidades
            } else {
                //sim: atualizar os produtos na sessão existente
                session()->push('cart', $produto);
            }


        } else {
            //não: criar sessão com o primeiro produto
            $produtos[] = $produto;
            session()->put('cart', $produtos);
        }

        flash('Produto adicionado ao carrinho')->success();
        return redirect()->route('produto.single',['slug' => $produto['slug']]);
    }

    public function remove($slug)
    {
        if (!session()->has('cart')) {
            return redirect()>route('cart.index');
        }

        $produtos = session()->get('cart');

        $produtos = array_filter($produtos, function ($linha) use ($slug){
            return $linha['slug'] != $slug;
        });

        session()->put('cart', $produtos);

        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        session()->forget('cart');
        flash('Desistencia da compra realizada com sucesso')->success();
        return redirect()->route('cart.index');
    }

    private function incrementaProduto($slug, $quantidade, $produtos)
    {
        $produtos = array_map(function($line) use ($slug, $quantidade){
            if ($slug == $line['slug']) {
                $line['quantidade'] += $quantidade;
            }
            return $line;
        }, $produtos);

        return $produtos;
    }
}
