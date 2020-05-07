<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
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
        $cartItens = session()->get('cart');
        $user = auth()->user();
        $reference = 'XPTO';


        $creditCardPayment = new CreditCard($cartItens, $user, $dataPost, $reference);

        $result = $creditCardPayment->doPayment();


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
