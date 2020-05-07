@extends('layouts.front')


@section('content')

    <h2 class="alert alert-success">
       Muito obrigado pela sua compra!
    </h2>

    <h3>
        Seu pedido foi processado: {{request()->get('order')}}
    </h3>

@endsection
