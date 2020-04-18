@extends('layouts.app')

@section('content')

    <a href="{{route('admin.loja.create')}}" class="btn btn-md btn-success mb-4 mt-4">Criar loja</a>

    <table class="table table-striped">
   <thead>
   <tr>
       <th>#</th>
       <th>Loja</th>
       <th>Ações</th>
   </tr>
   </thead>

    <tbody>
        @foreach($lojas as $loja)
            <tr>
                <td>{{$loja->id}}</td>
                <td>{{$loja->nome}}</td>
                <td>
                    <a href="{{route('admin.loja.edit', ['loja' => $loja->id])}}" class="btn btn-sm btn-primary">Editar</a>
                    <a href="{{route('admin.loja.destroy', ['loja' => $loja->id])}}" class="btn btn-sm btn-danger">Remover</a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{$lojas->links()}}

@endsection
