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

Route::get('/', function () {
    $helloWord['helloword'] = 'Hello Word';
    return view('welcome',$helloWord);
});

Route::get('/model', function (){
//    $produtos = \App\Produto::all();

//    $user = new \App\User();
    $user = \App\User::find(1);
    $user->name = 'Wenner Sanner Garcia Costa';
    $user->email = 'wennersanner@admin.com';
    $user->password = bcrypt('12345678');

//   return $user->save();

    return \App\User::all();
});
