@extends('layouts.app')

@section('content')

    <h2>Criar categoria</h2>

    <form action="{{route('admin.categorias.store')}}" method="post">
        @csrf

        <div class="form-group">
            <label>Categoria</label>
            <input type="text" name="nome" class="form-control  @error('nome') is-invalid   @enderror" value="{{@old('nome')}}">

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
            <label>Slug</label>
            <input type="text" name="slug" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">Criar categoria</button>
        </div>
    </form>
@endsection



