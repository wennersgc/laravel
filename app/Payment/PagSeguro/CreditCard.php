<?php


namespace App\Payment\PagSeguro;


class CreditCard
{
    private $itens;
    private $user;
    private $cardInfo;
    private $reference;

    public function __construct($itens, $user, $cardInfo, $reference)
    {
    	$this->itens = $itens;
    	$this->user = $user;
    	$this->cardInfo = $cardInfo;
        $this->reference = $reference;
    }

    public function doPayment()
    {
        //objeto cartão de credito
        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

        //email de quem vai receber o pagamento
        $creditCard->setReceiverEmail(ENV('PAGSEGURO_EMAIL'));
        //referencia para identificar a transação futuramente
        $creditCard->setReference($this->reference);
        //moeda
        $creditCard->setCurrency("BRL");

        //itens da compra
        foreach ($this->itens as $item) {
            $creditCard->addItems()->withParameters(
                $this->reference,
                $item['nome'],
                $item['quantidade'],
                $item['preco']
            );
        }

        // Informações do comprador.
        // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
        $user = $this->user;
        $email = ENV('PAGSEGURO_ENV') == 'sandbox'? 'teste@sandbox.pagseguro.com.br' : $user->email;
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
        $creditCard->setSender()->setHash($this->cardInfo['hash']);

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
        $creditCard->setToken($this->cardInfo['card_token']);

        //parcelas e valor
        list($quantidade, $valorParcela) = explode('|', $this->cardInfo['installment']);
        $valorParcela = number_format($valorParcela,2,'.', ',');
        $creditCard->setInstallment()->withParameters($quantidade, $valorParcela);

        //aniversario cliente
        $creditCard->setHolder()->setBirthdate('01/10/1979');

        //nome igual ao do cartão
        $creditCard->setHolder()->setName($this->cardInfo['cartao_nome']);

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

        return $result;
    }
}
