<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');


Route::get('/model', function (){
//    $produtos = \App\Produto::all();

//    $user = new \App\User();
//    $user = \App\User::find(1);
//    $user->name = 'Wenner Sanner Garcia Costa';
//    $user->email = 'wennersanner@admin.com';
//    $user->password = bcrypt('12345678');

//   return $user->save();

//    return \App\User::all();

////    Criar uma loja para um usuario
//    $user = \App\User::find(10);
//    $loja = $user->loja()->create([
//        'nome' => 'Loja do Usuario 10',
//        'descricao' => 'Decricao da loja do usuario 10',
//        'celular' => '(98)0999999999',
//        'fone' => '998) 8778878787',
//        'slug' => 'loja-usuario-10'
//    ]);
//
//    dd($loja);

//    Criar um produto para uma loja
//    $loja = \App\Loja::find(41);
//    $produto = $loja->produtos()->create([
//        'nome' => 'Produto da loja 41',
//        'descricao' => 'descricao do prioduto',
//        'informacoes' => 'Informações do produto',
//        'preco' => 222,
//        'slug' => 'informacoes-produto'
//    ]);
//
//    dd($produto);

//    Criar uma categoria

//    \App\Categoria::create([
//        'nome' => 'Games',
//        'descricao' => null,
//        'slug' => 'games',
//    ]);
//
//    \App\Categoria::create([
//        'nome' => 'Notebooks',
//        'descricao' => null,
//        'slug' => 'notebooks',
//    ]);

//    return \App\Categoria::all();

//    Adicionar produto para categoria ou vice-versa

//    $produto = \App\Produto::find(41);

//    dd($produto->categorias()->attach([1])); // adiciona
//    dd($produto->categorias()->detach([1])); // remove
//    dd($produto->categorias()->sync([1, 2]));
});

Route::group(['middleware' => ['auth']], function (){
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function (){

//    Route::prefix('lojas')->name('loja.')->group(function (){
//
//        Route::get('/', 'LojaController@index')->name('index');
//        Route::get('/create', 'LojaController@create')->name('create');
//        Route::post('/store', 'LojaController@store')->name('store');
//        Route::get('/{loja}/edit', 'LojaController@edit')->name('edit');
//        Route::post('/update/{loja}', 'LojaController@update')->name('update');
//        Route::get('/destroy/{loja}', 'LojaController@destroy')->name('destroy');
//    });

        Route::resource('lojas', 'LojaController');
        Route::resource('produtos', 'ProdutoController');
        Route::resource('categorias', 'CategoriaController');

        Route::post('fotos/removeFoto', 'ProdutoFotoController@removeFoto')->name('foto.remove');

    });

});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
