@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Pedidos recebidos</h2>
            <hr>
        </div>

        <div class="col-12">
            <div class="accordion" id="accordionExample">
                @forelse($orders as $key => $order)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                  Pedido nº: {{$order->reference}}
                                </button>
                            </h2>
                        </div>

                        <div id="collapse{{$key}}" class="collapse @if($key === 0) show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">

                                <ul class="list-group">
                                    @php $itens = unserialize($order->itens); @endphp

                                    @foreach(filterItensByLojaId($itens, auth()->user()->loja->id) as $item)

                                        <li class="list-group-item">
                                            <strong>Nome:</strong> {{$item['nome']}}
                                            <br>
                                            <strong>Quantidade:</strong> {{$item['quantidade']}}
                                            <br>
                                            <strong>Valor unitário:</strong> R$ {{number_format($item['preco'], '2', ',', '.')}}
                                            <br>
                                            <strong>Total:</strong>{{number_format(($item['preco'] * $item['quantidade']), 2, ',', '.')}}
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning">Nenhum pedido recebido!</div>
                @endforelse
            </div>
        </div>
        <div class="col-12 mt-2">
            {{$orders->links()}}
        </div>
    </div>

@endsection
