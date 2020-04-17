@extends('layouts.app')

@section('content')

    <h2>Criar loja</h2>

    <form action="{{route('admin.loja.salvar')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <div class="form-group">
            <label>Loja</label>
            <input type="text" name="nome" class="form-control">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control">
        </div>

        <div class="form-group">
            <label>Fone</label>
            <input type="text" name="fone" class="form-control">
        </div>

        <div class="form-group">
            <label>Celular</label>
            <input type="text" name="celular" class="form-control">
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control">
        </div>

        <div class="form-group">
            <label>Usuário</label>
            <select name="user" id="" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">Criar loja</button>
        </div>
    </form>
@endsection



