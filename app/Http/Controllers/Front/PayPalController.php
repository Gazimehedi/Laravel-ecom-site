<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PayPalController extends Controller
{
    private $apiContext;
    //
    public function index(Request $request){

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AblDtXLLAGHXjhdkaYklUVfEIU5tk_ut_nS438pUlOSmifCkd5VsragtjRiIbKVVGiKa2-gO3eVQn-Wl',     // ClientID
                'EEIUWO1MasepcIGpz4b8KQOQ5D2UQyqtWbVoQzSGFhfAf7ePEPo2_08QKwTGJU2i4C3LjDRy4pCe-LVD'      // ClientSecret
            )
        );
        $totalPrice = $request->session()->get('totalprice');
        // After Step 2
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        $amount->setTotal($totalPrice);
        $amount->setCurrency('USD');

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('This is the payment transaction description.');

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal_return'))
            ->setCancelUrl(route('paypal_cancel'));

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        // After Step 3
        try {
            $payment->create($apiContext);
            echo $payment;

            echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
            return redirect($payment->getApprovalLink());
        }
        catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }
    }

    public function paypalReturn(){
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AblDtXLLAGHXjhdkaYklUVfEIU5tk_ut_nS438pUlOSmifCkd5VsragtjRiIbKVVGiKa2-gO3eVQn-Wl',     // ClientID
                'EEIUWO1MasepcIGpz4b8KQOQ5D2UQyqtWbVoQzSGFhfAf7ePEPo2_08QKwTGJU2i4C3LjDRy4pCe-LVD'      // ClientSecret
            )
        );
        //dd(request()->all());
        // Get payment object by passing paymentId
        $paymentId = $_GET['paymentId'];
        $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
        $payerId = $_GET['PayerID'];

        // Execute payment with payer ID
        $execution = new \PayPal\Api\PaymentExecution();
        $execution->setPayerId($payerId);

        try {
        // Execute payment
        $result = $payment->execute($execution, $apiContext);
        // dd($result);
        // var_dump($result);
        
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
        echo $ex->getCode();
        echo $ex->getData();
        die($ex);
        }
        DB::table('orders')->where(['id'=>session('ORDER_ID')])
        ->update(['payment_id'=>$paymentId,'payer_id'=>$payerId,'payment_status'=>'success']);
        return redirect('/order_placed');

    }
    public function paypalCancel(Request $request){
        DB::table('orders')->where(['id'=>session('ORDER_ID')])
        ->update(['payment_id'=>$request->token,'payment_status'=>'canceled']);
        return view('front.order_canceled');
    }
}
