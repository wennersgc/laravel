@extends('layouts.app')

@section('content')

    <a href="{{route('admin.produtos.create')}}" class="btn btn-md btn-success mb-4 mt-4">Criar produto</a>

    <table class="table table-striped">
   <thead>
   <tr>
       <th>#</th>
       <th>Nome</th>
       <th>Preço</th>
       <th>Ações</th>
   </tr>
   </thead>

    <tbody>
        @foreach($produtos as $produto)
            <tr>
                <td>{{$produto->id}}</td>
                <td>{{$produto->nome}}</td>
                <td>R$ {{$produto->preco}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('admin.produtos.edit', ['produto' => $produto->id])}}" class="btn btn-sm btn-primary mr-2">Editar</a>
                        <form action="{{route('admin.produtos.destroy', ['produto' => $produto->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{$produtos->links()}}

@endsection
