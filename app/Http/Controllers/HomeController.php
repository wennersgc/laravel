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
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produtos = $this->produto->limit(9)->orderBy('id', 'DESC')->get();

        return view('welcome', compact('produtos'));
    }
}
