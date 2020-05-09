<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LojaRequest;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;

class LojaController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
    	$this->middleware('user.has.loja')->only(['create', 'store']);
    }

    public function index()
    {
        $loja = auth()->user()->loja;
        return view('admin.lojas.index', compact('loja'));
    }

    public function create()
    {
        $users = \App\User::all(['id', 'name']);
        return view('admin.lojas.criar', compact('users'));
    }

    public function store(LojaRequest $request)
    {
        $data = $request->all();
        $user = auth()->user();

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $user->loja()->create($data);

       flash('Loja criada com sucesso')->success();
        return redirect()->route('admin.lojas.index');
    }

    public function show($id)
    {
        return redirect()->route('admin.lojas.index');
    }


    public function edit($loja)
    {
        $loja =\App\Loja::find($loja);
//        dd($loja);

        return view('admin.lojas.editar', compact('loja'));
    }

    public function update(LojaRequest $request, $loja)
    {
        $data = $request->all();

        $loja= \App\Loja::find($loja);

        if ($request->hasFile('logo')) {

            if (Storage::disk('public')->exists($loja->logo)) {
                Storage::disk('public')->delete($loja->logo);
            }

            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $loja->update($data);

        flash('Loja atualizada comsucesso')->success();
        return redirect()->route('admin.lojas.index');
    }

    public function destroy($loja)
    {
        $loja = \App\Loja::find($loja);
        $loja->delete();

        flash('Loja removida com sucesso')->success();
        return redirect()->route('admin.lojas.index');
    }
}
