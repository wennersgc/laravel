<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Produto;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use App\Http\Requests\ProdutoRequest;

class ProdutoController extends Controller
{
    use UploadTrait;
    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarioLoja = auth()->user()->loja;
        $produtos = $usuarioLoja->produtos()->paginate(10);

        return  view('admin.produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = \App\Categoria::all(['id', 'nome']);

        return  view('admin.produtos.criar', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        $data = $request->all();
        $categorias = $request->get('categorias', null);

        $loja = auth()->user()->loja;
        $produto = $loja->produtos()->create($data);

        $produto->categorias()->sync( $categorias);

        if ($request->hasFile('fotos')) {
            $images = $this->imageUpload($request->file('fotos'), 'image');

            $produto->fotos()->createMany($images);
        }

        flash('Produto criado com sucesso')->success();
        return redirect()->route('admin.produtos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($produto)
    {
        $produto = $this->produto->findOrFail($produto);
        $categorias = \App\Categoria::all(['id', 'nome']);
        $lojas = \App\Loja::all(['id', 'nome']);

        return  view('admin.produtos.editar', compact('produto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $produto)
    {
        $data = $request->all();
        $categorias = $request->get('categorias', null);

        $produto = $this->produto->find($produto);
        $produto->update($data);

        if (!is_null($categorias)) {
            $produto->categorias()->sync($categorias);
        }

        if ($request->hasFile('fotos')) {
            $images = $this->imageUpload($request->file('fotos'), 'image');

            $produto->fotos()->createMany($images);
        }

        flash('Produto atualizado com sucesso')->success();
        return redirect()->route('admin.produtos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($produto)
    {
        $produto = $this->produto->find($produto);
        $produto->delete();

        flash('Produto removido com sucesso');
        return redirect()->route('admin.produtos.index');
    }

}
