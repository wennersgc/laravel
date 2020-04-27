<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProdutosFotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoFotoController extends Controller
{
    public function removeFoto(Request $request)
    {
        $fotoName = $request->get('fotoName');

        //verificar se arquivo existe
        if (Storage::disk('public')->exists($fotoName) ) {
            //remove dos arquivo
            Storage::disk('public')->delete($fotoName);
        }

        $removeFoto = ProdutosFotos::where('image', $fotoName);
        $produtoID = $removeFoto->first()->produto_id;
        //remove do banco
        $removeFoto->delete();

        flash('Imagem removida com sucesso')->success();
        return redirect()->route('admin.produtos.edit', ['produto' => $produtoID]);
    }
}
