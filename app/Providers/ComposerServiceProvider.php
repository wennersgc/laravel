<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //        $categorias = \App\Categoria::all(['nome', 'slug']);

//        view()->share('categorias', $categorias);

//        view()->composer('*', function ($view) use ($categorias) {
//            $view->with('categorias', $categorias);
//        });

//        dd('ok');
        view()->composer('*', '\App\Http\Views\CategoriaViewsComposer@composer');
    }
}
