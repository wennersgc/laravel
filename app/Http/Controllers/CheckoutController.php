<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
//       session()->forget('pagseguro_session_code');
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->makePagSeguroSession();

        $total = 0;

        $cartItens = array_map(function ($linha){
            return $linha['quantidade'] *= $linha['preco'];
        }, session()->get('cart'));

        $cartItens = array_sum($cartItens);

        return view('checkout', compact('cartItens'));
    }

    public function proccess(Request $request)
    {
        $dataPost = $request->all();

        $reference = 'XPTO';

        //objeto cartão de credito
        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

        //email de quem vai receber o pagamento
        $creditCard->setReceiverEmail(ENV('PAGSEGURO_EMAIL'));
        //referencia para identificar a transação futuramente
        $creditCard->setReference($reference);
        //moeda
        $creditCard->setCurrency("BRL");

        $cartItens = session()->get('cart');

        //itens da compra
        foreach ($cartItens as $item) {
            $creditCard->addItems()->withParameters(
                $reference,
                $item['nome'],
                $item['quantidade'],
                $item['preco']
            );
        }

        // Informações do comprador.
        // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
        $user = auth()->user();
        $email = ENV('PAGSEGURO_ENV') == 'sandbox'? 'teste@sandbox.pagseguro.com.br' : $user->emil;
        $creditCard->setSender()->setName($user->name);
        $creditCard->setSender()->setEmail($email);

        //telefone usuario
        $creditCard->setSender()->setPhone()->withParameters(
            11,
            56273440
        );
        //cpf
        $creditCard->setSender()->setDocument()->withParameters(
            'CPF',
            '77462061155'
        );

        //hash do cartao
        $creditCard->setSender()->setHash($dataPost['hash']);

        //ip do usuario
        $creditCard->setSender()->setIp('127.0.0.0');

        //endereço de entrega
        $creditCard->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        //endereço para o cartçao de credito
        $creditCard->setBilling()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        //toke cartão
        $creditCard->setToken($dataPost['card_token']);

        //parcelas e valor
        list($quantidade, $valorParcela) = explode('|', $dataPost['installment']);
        $valorParcela = number_format($valorParcela,2,'.', '');
        $creditCard->setInstallment()->withParameters($quantidade, $valorParcela);

        //aniversario cliente
        $creditCard->setHolder()->setBirthdate('01/10/1979');

        //nome igual ao do cartão
        $creditCard->setHolder()->setName($dataPost['cartao_nome']);

        $creditCard->setHolder()->setPhone()->withParameters(
            11,
            56273440
        );

        //cpf do titular do cartão
        $creditCard->setHolder()->setDocument()->withParameters(
            'CPF',
            '77462061155'
        );

        //modo de pagamento
        $creditCard->setMode('DEFAULT');

        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

//        var_dump($result);

        $userOrder =  [
            'reference' => $reference,
            'pagseguro_code' => $result->getCode(),
            'pagseguro_status' => $result->getStatus(),
            'itens' => serialize($cartItens),
            'loja_id' => 1
        ];

        $user->orders()->create($userOrder);

        return response()->json([
            'data' => [
                'status' => true,
                'message' => 'Pedido criado com sucesso'
            ]
        ]);
    }

    private function makePagSeguroSession()
    {
        if (!session()->has('pagseguro_session_code')) {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }

    }
}
