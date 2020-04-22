@extends('layouts.app')

@section('content')

    <h2>Atualizar loja</h2>

    <form action="{{route('admin.lojas.update', ['loja' => $loja->id])}}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Loja</label>
            <input type="text" name="nome" class="form-control" value="{{$loja->nome}}">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control" value="{{$loja->descricao}}">
        </div>

        <div class="form-group">
            <label>Fone</label>
            <input type="text" name="fone" class="form-control" value="{{$loja->fone}}">
        </div>

        <div class="form-group">
            <label>Celular</label>
            <input type="text" name="celular" class="form-control" value="{{$loja->celular}}">
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$loja->slug}}">
        </div>

      <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">Atualizar loja</button>
        </div>
    </form>
@endsection




