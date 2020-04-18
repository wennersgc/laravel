@extends('layouts.app')

@section('content')

    <a href="{{route('admin.lojas.create')}}" class="btn btn-md btn-success mb-4 mt-4">Criar loja</a>

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
                    <div class="btn-group">
                        <a href="{{route('admin.lojas.edit', ['loja' => $loja->id])}}" class="btn btn-sm btn-primary mr-2">Editar</a>
                        <form action="{{route('admin.lojas.destroy', ['loja' => $loja->id])}}" method="post">
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

{{$lojas->links()}}

@endsection
