@extends('layouts.app')

@section('content')

    <h2>Criar Produto</h2>

    <form action="{{route('admin.produtos.store')}}" method="post">
        @csrf

        <div class="form-group">
            <label>Produto</label>
            <input type="text" name="nome" class="form-control">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control">
        </div>

        <div class="form-group">
            <label>Informações</label>
            <textarea name="informacoes" cols="30" rows="10" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input type="text" name="preco" class="form-control">
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control">
        </div>

        <div class="form-group">
            <label>Lojas</label>
            <select name="loja" class="form-control">
                @foreach($lojas as $loja)
                    <option value="{{$loja->id}}">{{$loja->nome}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">Criar produto</button>
        </div>
    </form>
@endsection



