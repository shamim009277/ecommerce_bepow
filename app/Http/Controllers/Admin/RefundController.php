<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use PayPal\Api\Amount;
use PayPal\Api\Refund;
use PayPal\Api\Sale;
use DB;
use Session;


class RefundController extends Controller
{
    public function paypalPaymentRefund($id){

       $payment = DB::table('payments')
                 ->where('pay_id',$id)
                 ->first();
       $order = DB::table('oreders')
               ->where('payment_id',$payment->id)
               ->first();
       $id = $id;  

       return view('admin.paypal_refund',compact('payment','order','id'));

    }

    public function paypalPaymentRefundCreate(Request $request){

	    	
	    	$amount = $request->refund_amount; 
	    	 $apiContext = new \PayPal\Rest\ApiContext(
			  new \PayPal\Auth\OAuthTokenCredential(
			    env('PAYPAL_CLIENT_ID'),
			    env('PAYPAL_SECRET_ID')
			  )
			);

          $amt = new Amount();
          $amt->setTotal(10)
            ->setCurrency('USD');


          $refund = new Refund();
          $refund->setAmount($amt);
          
          $sale = new Sale();
          $sale->setId('6XW8105732501812E');
          //dd($sale);
          try {
            $refundedSale = $sale->refund($refund, $apiContext);
            //dd($refundedSale);
          } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
          } catch (Exception $ex) {
            die($ex);
          }
  

    }
}
