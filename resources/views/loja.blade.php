@extends('layouts.front')


@section('content')

    <div class="row front">

        <div class="col-4">
            @if($loja->logo)
                <img src="{{asset('storage/' . $loja->logo)}}" alt="Logo da {{$loja->nome}}" class="img-fluid">

            @else
                <img src="{{asset('assets/img/loja-sem-logo.png')}}" alt="Logo da {{$loja->nome}}" class="img-fluid">
            @endif
        </div>

        <div class="col-8">
            <h2>{{$loja->nome}}</h2>
            <p>{{$loja->descricao}}</p>
            <p>
                <strong>Contatos</strong>
                <span>Fixo: {{$loja->fone}}</span> | Cel: <span>{{$loja->celular}}</span>
            </p>
        </div>

        <div class="col-12 mb-4">
            <hr>
            <h3>Produtos desta loja</h3>
        </div>

        @forelse($loja->produtos as $key => $produto)

            <div class="col-md-4">
                <div class="card" style="width: 98%">

                    @if($produto->fotos->count())
                        <img src="{{asset('storage/' . $produto->fotos->first()->image)}}" alt=""
                             class="car-img-top img-thumbnail">

                    @else
                        <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="car-img-top img-thumbnail">

                    @endif

                    <div class="card-body">
                        <h2 class="card-title">{{$produto->nome}}</h2>
                        <p class="card-text">{{$produto->descricao}}</p>

                        <h3>R$ {{number_format($produto->preco, '2',',', '.')}}</h3>

                        <a href="{{route('produto.single', ['slug' => $produto->slug])}}" class="btn btn-success">
                            Ver produto
                        </a>
                    </div>
                </div>
            </div>

            @if(($key + 1) % 3 == 0)
    </div>
    <div class="row front">
        @endif

        @empty
            <div class="col-12">
                <h3 class="alert alert-warning">Loja sem produtos</h3>
            </div>
        @endforelse
    </div>


@endsection
