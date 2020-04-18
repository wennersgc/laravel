<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    public function index()
    {
        $lojas = \App\Loja::paginate(10);

        return view('admin.lojas.index', compact('lojas'));
    }

    public function create()
    {
        $users = \App\User::all(['id', 'name']);
        return view('admin.lojas.criar', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $user = \App\User::find($data['user']);
        $loja = $user->loja()->create($data);

       flash('Loja criada com sucesso')->success();
        return redirect()->route('admin.loja.index');
    }

    public function edit($loja)
    {
        $loja =\App\Loja::find($loja);

        return view('admin.lojas.editar', compact('loja'));
    }

    public function update(Request $request, $loja)
    {
        $data = $request->all();

        $loja= \App\Loja::find($loja);

        $loja->update($data);

        flash('Loja atualizada comsucesso')->success();
        return redirect()->route('admin.loja.index');
    }

    public function destroy($loja)
    {
        $loja = \App\Loja::find($loja);
        $loja->delete();

        flash('Loja removida com sucesso')->success();
        return redirect()->route('admin.loja.index');
    }
}