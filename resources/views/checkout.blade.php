@extends('layouts.front')

@section('stylesheets')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

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

            <form action="" method="post">

                <div class="row mb-3">
                    <div class="col-md-10">
                        <label for="cartao_nome">Nome no cartão</label>
                        <input type="text" class="form-control" name="cartao_nome">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-10">
                        <label for="cartao_numero">Numero do cartão <span class="brand"></span></label>
                        <input type="text" class="form-control" name="cartao_numero">
                        <input type="hidden" name="cartao_brand">
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

                    <div class="col-md-12 installments form-group">
                    </div>
                </div>

                <button class="btn btn-lg btn-success proccessCheckout">Efetuar pagamento</button>
            </form>

        </div>

    </div>

@endsection

@section('scripts')

    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}'
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script>
        let valorTransacao = '{{$cartItens}}'
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
                        document.querySelector('input[name=cartao_brand]').value = res.brand.name;

                        getInstallments(valorTransacao, res.brand.name);
                    },

                    error: function (err) {
                        console.log(err);
                    },

                    complete: function (res) {
                    }
                });
            }
        });


        let submitButton = document.querySelector('button.proccessCheckout');

        submitButton.addEventListener('click', function(event){

            event.preventDefault();

            PagSeguroDirectPayment.createCardToken({
                cardNumber: document.querySelector('input[name=cartao_numero]').value,
                brand: document.querySelector('input[name=cartao_brand]').value,
                cvv: document.querySelector('input[name=cartao_cvv]').value,
                expirationMonth: document.querySelector('input[name=cartao_mes]').value,
                expirationYear: document.querySelector('input[name=cartao_ano]').value,

                success: function (res) {
                    // console.log(res);
                    proccessPayment(res.card.token);
                },
            });
        });


        function proccessPayment(token) {

            let data = {
                card_token: token,
                hash:   PagSeguroDirectPayment.getSenderHash(),
                installment: document.querySelector('select.select_installments').value,
                cartao_nome: document.querySelector('input[name=cartao_nome]').value,
                _token: '{{csrf_token()}}'
            }

            $.ajax({
                type: 'POST',
                url:'{{route("checkout.proccess")}}',
                data: data,
                dataType: 'json',

                success: function (res) {
                    toastr.success(res.data.message, 'Sucesso')
                    window.location.href ='{{route("checkout.obrigado")}}?order=' + res.data.order ;
                }
            });
        }


        function getInstallments(total, brand) {

            PagSeguroDirectPayment.getInstallments({
                amount: total,
                brand: brand,
                //parcelas em que assumimos os juros - 0 = sem juros
                maxInstallmentNoInterest: 0,

                success: function (res) {
                    let selectInstallments = drawSelectInstallments(res.installments[brand]);
                    document.querySelector('div.installments').innerHTML = selectInstallments;
                }
            })
        }


        function drawSelectInstallments(installments) {
            let select = '<label>Opções de Parcelamento:</label>';

            select += '<select class="form-control select_installments">';

            for(let l of installments) {
                select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
            }


            select += '</select>';

            return select;
        }
    </script>

@endsection
