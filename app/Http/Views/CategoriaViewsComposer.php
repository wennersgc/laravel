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
        return $view->with('categorias', $this->categoria->all(['nome', 'slug']));
    }
}
