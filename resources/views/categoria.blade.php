@extends('layouts.front')


@section('content')

    <div class="row front">

        <div class="col-12">
            <h2>{{$categoria->nome}}</h2>
            <hr>
        </div>

            @forelse($categoria->produtos as $key => $produto)

                <div class="col-md-4">
                    <div class="card" style="width: 98%">

                        @if($produto->fotos->count())
                            <img src="{{asset('storage/' . $produto->fotos->first()->image)}}" alt="" class="car-img-top img-thumbnail">

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
                     </div><div class="row front">
                @endif

        @empty
            <div class="col-12">
                <h3 class="alert alert-warning">Categoria sem produto</h3>
            </div>
        @endforelse
    </div>


@endsection
