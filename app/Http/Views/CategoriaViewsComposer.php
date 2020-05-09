<?php


namespace App\Http\Views;


use App\Categoria;

class CategoriaViewsComposer
{
    private $categoria;

    public function __construct(Categoria $categoria)
    {
        $this->categoria = $categoria;
    }

    public function composer($view)
    {
        $categorias = $this->categoria->paginate(10);
        return $view->with('categorias', $categorias);
    }
}
