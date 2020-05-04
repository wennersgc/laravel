@extends('layouts.front')

@section('content')

    <div class="container">

        <div class="col-md-6">

            <div class="row mb-2">
                <div class="col-md-12">
                    <h2>
                        Dados para pagamento
                        <hr>
                    </h2>
                </div>
            </div>

            <form action=""method="post">

                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="numero_cartao">Numero do cartão</label>
                        <input type="text" class="form-control" name="cartao_numero">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="cartao_mes">Mês de expiração</label>
                        <input type="text" class="form-control" name="cartao_mes">
                    </div>

                    <div class="col-md-4">
                        <label for="cartao_ano">Ano de expiração</label>
                        <input type="text" class="form-control" name="cartao_ano">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-5">
                        <label for="cartao_cvv">Código de segurança</label>
                        <input type="text" class="form-control" name="cartao_cvv">
                    </div>
                </div>

                <button class="btn btn-lg btn-success">Efetuar pagamento</button>
            </form>

        </div>

    </div>

@endsection
