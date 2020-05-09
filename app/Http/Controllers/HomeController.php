<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function index()
    {
        $produtos = $this->produto->limit(6)->orderBy('id', 'DESC')->get();
        $lojas = \App\Loja::limit(3)->orderBy('id', 'DESC')->get();

        return view('welcome', compact('produtos', 'lojas'));
    }

    public function single($slug)
    {
       $produto = $this->produto->whereSlug($slug)->first();

       return view('single', compact('produto'));
    }
}
