@extends('layouts.app')

@section('content')

    <h2>Atualizar Produto</h2>

    <form action="{{route('admin.produtos.update', ['produto' => $produto->id])}}" method="post" enctype="multipart/form-data">
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
            <label for="categorias">Categorias</label>
            <select name="categorias[]" id="" multiple class="form-control">
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}" @if($produto->categorias->contains($categoria)) selected @endif>
                        {{$categoria->nome}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fotos">Fotos do produto</label>
            <input type="file" name="fotos[]" class="form-control @error('fotos.*') is-invalid @enderror" multiple>

            @error('fotos')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">Atualizar produto</button>
        </div>
    </form>

    <hr>
    <div class="row">
        @foreach($produto->fotos as $foto)
            <div class="col-md-4 text-center">
                <img src="{{asset('storage/' . $foto->image)}}" alt="" class="img-fluid">

                <form action="{{route('admin.foto.remove')}}" method="post">
                    @csrf
                    <input type="hidden" name="fotoName" value="{{$foto->image}}">

                    <button class="btn btn-lg btn-danger">Remover</button>
                </form>

            </div>
        @endforeach
    </div>
@endsection




