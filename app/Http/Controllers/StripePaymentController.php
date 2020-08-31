<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use App\OrderDetail;
use App\Oreder;
use App\Payment;
use App\shipping;
use Session;
use Cart;

class StripePaymentController extends Controller
{
    public function index(){

    	return view('frontend.stripe_payment');
    }

    public function store(Request $request){

    	 //dd($request->all());
    	 try {

    	 	// Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
        
        $stripe = new Stripe('sk_test_ubpjYpwN3JEgSd8xxUqWoOJt00LwOrvWiX', '2019-03-14');
    	 	$charge = $stripe->charges()->create([
			    'currency' => 'USD',
			    'amount'   => Cart::getTotal(),
			    'description' => 'Order',
          'source' => $request->stripeToken,
			]);
    	 	  //dd($charge);
            if($charge){

               $shipping = Session::get('shipping_id'); 
               $data = array();

               $data['user_id'] = Auth::user('web')->id;
               $data['shipping_id'] = $shipping->id;
               $data['transaction_id'] = $charge['id'];
               /*$charge['balance_transaction'];*/
               $data['payment_method'] = $charge['payment_method'];
               $data['payment_type']   = strtoupper($charge['payment_method_details']['card']['brand']).' '.strtoupper($charge['payment_method_details']['type']);
               $data['card_number']    = $charge['payment_method_details']['card']['last4'];
               $data['currency']       =strtoupper($charge['currency']);
               $data['amount']         = $charge['amount'] /100;
               $data['payment_status'] = $charge['status'];
               $data['receipt_email']  = $shipping->email;
               $data['receipt_url']    = $charge['receipt_url'];
               $data['postal_code']    = $shipping->zip;
               $data['status']         = 1;

              $payment=Payment::create($data);
              Session::put('payment',$payment);

            if ($payment) {
            
               $ship = Session::get('shipping'); 
               $data = array();
               $payment = Session::get('payment');
               
               $data['user_id'] = Auth::user('web')->id;
               $data['shipping_id'] = $shipping->id;
               $data['payment_id'] = $payment->id;
               $data['quantity'] = Cart::getTotalQuantity();
               $data['subtotal'] = Cart::getSubTotal();
            if($ship == 'Premium Shipping'){
               $data['shipping_cost'] = 20.5;
               }
            else{
               $data['shipping_cost'] = 0;
            }
               $data['total'] = Cart::getTotal();
               $data['status'] = 1;
               $order = Oreder::create($data);
               Session::put('order',$order);
               } 

              if($order) {

             $items = Cart::getContent();
             $order = Session::get('order');
             $data=array();
          foreach($items as $item){

             $data['order_id'] = $order->id;
             $data['user_id'] = Auth::user('web')->id;
             $data['shipping_id'] = $shipping->id;
             $data['item_name'] = $item->name;
             $data['image'] = $item->attributes->image;
             $data['price'] = $item->price;
             $data['quantity'] = $item->quantity;
             $data['status'] = 1;

             $order_details = OrderDetail::create($data);
                 
             }
             } 
                 
           }

           Cart::clearCartConditions();
           Cart::clear();
           return redirect('/user_panel');  
    	 	
    	 } catch (Exception $e) {
    	 	echo "Something Wrong";
    	 }
    }
}
