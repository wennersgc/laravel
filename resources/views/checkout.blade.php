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
                    <div class="col-md-10">
                        <label for="numero_cartao">Numero do cartão <span class="brand"></span></label>
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

@section('scripts')

    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}'
        PagSeguroDirectPayment.setSessionId(sessionId);
        // PagSeguroDirectPayment.setSessionId(sessionId);
;    </script>

    <script>
        //pegando bandeira
        let cartaoNumero = document.querySelector('input[name=cartao_numero]');
        let spanBrand =  document.querySelector('span.brand');

        cartaoNumero.addEventListener('keyup', function(){
             if(cartaoNumero.value.length >= 6) {
                 PagSeguroDirectPayment.getBrand({
                     cardBin: cartaoNumero.value.substr(0, 6),

                     success: function (res) {
                            let imgFlag =`<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png" />`;
                            spanBrand.innerHTML = imgFlag;
                     },

                     error: function (err) {
                        console.log(error);
                    },

                     complete: function (res) {
                       // console.log('Complete: ' + res);
                     }
                 });
             }
        });
    </script>

@endsection
