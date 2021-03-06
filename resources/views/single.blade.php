@extends('layouts.front')

@section('content')

<div class="row">
    <div class="col-6">
       @if($produto->fotos->count())
            <img src="{{asset('storage/' . $produto->fotos->first()->image)}}" alt="" class="car-img-top">

            <div class="row mt-4">
                @foreach($produto->fotos  as $foto)
                    <div class="col-4">
                        <img src="{{asset('storage/' . $foto->image)}}" alt="" class="img-fluid">
                    </div>
                @endforeach
            </div>

        @else
            <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="img-fluid img-thumbnail">
        @endif
    </div>

    <div class="col-6">
            <div class="col-md-12">
                <h2>{{$produto->nome}}</h2>
                <p>
                    {{$produto->descrcao}}
                </p>

                <h3>R$ {{number_format($produto->preco, '2',',', '.')}}</h3>

                <span>Loja: {{$produto->loja->nome}}</span>
            </div>

            <div class="produto-add col-md-12">

                <hr>

                <form action="{{route('cart.add')}}" method="post">
                    @csrf

                    <input type="hidden" name="produto[nome]" value="{{$produto->nome}}">
                    <input type="hidden" name="produto[preco]" value="{{$produto->preco}}">
                    <input type="hidden" name="produto[slug]" value="{{$produto->slug}}">

                    <div class="form-group">
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" name="produto[quantidade]" class="form-control col-md-2" value="1">
                    </div>

                    <button type="submit" class="btn-lg btn-danger">Comprar</button>

                </form>

            </div>
    </div>
</div>

    <div class="row">
        <div class="col-12">
            <hr>
            {{$produto->informacoes}}
        </div>
    </div>
@endsection
