@extends('layouts.app')

@section('content')

    @if($categorias)
        <a href="{{route('admin.categorias.create')}}" class="btn btn-md btn-success mb-4 mt-4">Criar categoria</a>


    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Categoria</th>
            <th>Slug</th>
            <th>Ações</th>
        </tr>
        </thead>

        <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <td>{{$categoria->id}}</td>
                <td>{{$categoria->nome}}</td>
                <td>{{$categoria->slug}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('admin.categorias.edit', ['categoria' => $categoria->id])}}" class="btn btn-sm btn-primary mr-2">Editar</a>
                        <form action="{{route('admin.categorias.destroy', ['categoria' => $categoria->id])}}" method="post">
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
        {{$categorias->links()}}
    @endif
@endsection
