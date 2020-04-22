@extends('layouts.app')

@section('content')

    <h2>Atualizar loja</h2>

    <form action="{{route('admin.categorias.update', ['categoria' => $categoria->id])}}" method="post">
        @csrf
        @method('PUT')

        @if (isset($errors) && count($errors))

            Erros: {{count($errors->all())}} Error(s)
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }} </li>
                @endforeach
            </ul>

        @endif


        <div class="form-group">
            <label>Categoria</label>
            <input type="text" name="nome" class="form-control  @error('nome') is-invalid   @enderror" value="{{$categoria->nome}}">

            @error('nome')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control @error('descricao') is-invalid   @enderror" value="{{$categoria->descricao}}">

            @error('descricao')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$categoria->slug}}">
        </div>

      <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">Atualizar categoria</button>
        </div>
    </form>
@endsection




