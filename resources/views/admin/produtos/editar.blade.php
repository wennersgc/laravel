@extends('layouts.app')

@section('content')

    <h2>Atualizar Produto</h2>

    <form action="{{route('admin.produtos.update', ['produto' => $produto->id])}}" method="post">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Produto</label>
            <input type="text" name="nome" class="form-control @error('nome') is-invalid   @enderror" value="{{$produto->nome}}">

            @error('nome')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control @error('descricao') is-invalid   @enderror" value="{{$produto->descricao}}">

            @error('descricao')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Informações</label>
            <textarea name="informacoes" cols="30" rows="10" class="form-control @error('informacoes') is-invalid   @enderror">{{$produto->informacoes}}</textarea>

            @error('informacoes')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input type="text" name="preco" class="form-control @error('preco') is-invalid   @enderror" value="{{$produto->preco}}">

            @error('preco')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$produto->slug}}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">Atualizar produto</button>
        </div>
    </form>
@endsection




