@extends('layouts.app')

@section('content')

    <h2>Criar Produto</h2>

    <form action="{{route('admin.produtos.store')}}" method="post">
        @csrf

         <div class="form-group">
            <label>Produto</label>
            <input type="text" name="nome" class="form-control @error('nome') is-invalid   @enderror" value="{{@old('nome')}}">

            @error('nome')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control @error('descricao') is-invalid   @enderror" value="{{@old('descricao')}}">

            @error('descricao')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Informações</label>
            <textarea name="informacoes" cols="30" rows="10" class="form-control @error('informacoes') is-invalid   @enderror">{{@old('informacoes')}}</textarea>

            @error('informacoes')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input type="text" name="preco" class="form-control @error('preco') is-invalid   @enderror" value="{{@old('preco')}}">

            @error('preco')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="categorias">Categorias</label>
            <select name="categorias[]" id="" multiple class="form-control">
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">Criar produto</button>
        </div>
    </form>
@endsection



