@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <a href="{{route('admin.notifications.todas.lidas')}}" class="btn btn-md btn-success mb-4 mt-4">Marcar todas como lidas</a>
            <hr>
        </div>
    </div>

    <table class="table table-striped">
   <thead>
   <tr>
       <th>Notificação</th>
       <th>Criada em</th>
       <th>Tempo decorrido</th>
       <th>Ações</th>
   </tr>
   </thead>

    <tbody>

        @forelse($unreadNotifications as $n)
            <tr>
                <td>{{$n->data['message']}}</td>
                <td>{{$n->created_at->format('d/m/Y H:i:s')}}</td>
                <td>{{$n->created_at->locale('pt')->diffForHumans()}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('admin.notifications.ler',['notificacao' => $n->id])}}" class="btn btn-sm btn-primary mr-2">Marcar como lida</a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    <div class="alert alert-warning">Nenhuma notificação encontrada</div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{--{{$produtos->links()}}--}}

@endsection
