<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use App\OrderDetail;
use App\Oreder;
use App\shipping;
use DB;
use Session;
use Cart;

session_start();
class PaypalPaymentController extends Controller
{
    public function index(){

    	return view('frontend.paypal_payment');
    }


    public function paypal(Request $request){
    	
    	//return $request->all();
    	//$data = Auth::user('web')->first_name;
    	//dd($data);
    	$apiContext = new \PayPal\Rest\ApiContext(
		  new \PayPal\Auth\OAuthTokenCredential(
		    env('PAYPAL_CLIENT_ID'),
		    env('PAYPAL_SECRET_ID')
		  )
		);

		// Create new payer and method
		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		// Set redirect URLs
		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl(route('process.paypal'))
		  ->setCancelUrl(route('cancel.paypal'));
	

		// Set payment amount
		$amount = new Amount();
		$amount->setCurrency("USD")
		  ->setTotal(Cart::getTotal());

        //Cart Data
		$collection = Cart::getContent();
		//dd($collection);
    foreach ($collection as $key => $item) {
    }
		//Set Item 

		$item_1 = new Item();
    $item_1->setName($item->name) /** item name **/
           ->setCurrency('USD')
           ->setQuantity($item->quantity)
           ->setPrice(Cart::getTotal());

    $item_list = new ItemList();
    $item_list->setItems(array($item_1));
    //dd($item_list);

    $details = new Details(); 
    $details ->setShipping(10) 
             -> setTax(0) 
             -> setSubtotal(Cart::getSubTotal());  

		// Set transaction object
		$transaction = new Transaction();
		$transaction->setAmount($amount)
		            ->setItemList($item_list)
		            ->setDescription("Description");

		// Create the full payment object
		$payment = new Payment();
		$payment->setIntent('sale')
		  ->setPayer($payer)
		  ->setRedirectUrls($redirectUrls)
		  ->setTransactions(array($transaction));

     //dd($payment);
		// Create payment with valid API context
		try {
		  $payment->create($apiContext);

		  // Get PayPal redirect URL and redirect the customer
		  $approvalUrl = $payment->getApprovalLink();
		 
		  return redirect($approvalUrl);
      //dd($approvalUrl);
		  // Redirect the customer to $approvalUrl
		} catch (PayPal\Exception\PayPalConnectionException $ex) {
		  echo $ex->getCode();
		  echo $ex->getData();
		  die($ex);
		} catch (Exception $ex) {
		  die($ex);
		}  

    }

    public function returnPaypal(Request $request){
      
      $apiContext = new \PayPal\Rest\ApiContext(
		  new \PayPal\Auth\OAuthTokenCredential(
		    env('PAYPAL_CLIENT_ID'),
		    env('PAYPAL_SECRET_ID')
		  )
		);

      // Get payment object by passing paymentId
		$paymentId = $request->paymentId;
		$payment = Payment::get($paymentId, $apiContext);
		$payerId = $request->PayerID;

		// Execute payment with payer ID
		$execution = new PaymentExecution();
		$execution->setPayerId($payerId);

		try {
		  // Execute payment
		  $result = $payment->execute($execution, $apiContext);
      //dd($result);
		  if (isset($result)) {
         //dd($result);
//data stored in payments table
        $data=array();
        $shipping = Session::get('shipping_id');

        $data['user_id'] = Auth::user('web')->id;
        $data['shipping_id'] = $shipping->id;
        $data['pay_id'] = $result->transactions[0]->related_resources[0]->sale->id;
        $data['transaction_id'] = $result->id;
        $data['payment_method'] = $result->payer->payment_method;
        $data['payment_type']   = "PayPal";
        $data['card_number']    = $result->cart;
        $data['currency']       = $result->transactions[0]->amount->currency;
        $data['amount']         = $result->transactions[0]->amount->total;
        $data['payment_status'] = $result->payer->status;
        $data['receipt_email']  = $result->payer->payer_info->email;
        $data['receipt_url']    = $result->transactions[0]->related_resources[0]->sale->links[1]->href;
        $data['postal_code']    = $result->payer->payer_info->shipping_address->postal_code;
        $data['status']         = 1;

        $payment_id = DB::table('payments')
                  ->insertGetId($data);
             Session::put('payment_id',$payment_id);
      
//data stored in orders table
         
         $ship = Session::get('shipping'); 
         $data = array();


         $data['user_id'] = Auth::user('web')->id;
         $data['shipping_id'] = $shipping->id;
         $data['payment_id'] = Session::get('payment_id');
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

         $order_id = DB::table('oreders')
                    ->insertGetId($data);
         Session::put('order_id',$order_id);
         
          
 //Data store in Order Details Table 
            
         $items = Cart::getContent();
         $data=array();
         
         foreach($items as $item){

          $data['order_id'] = Session::get('order_id');
          $data['user_id'] = Auth::user('web')->id;
          $data['shipping_id'] = $shipping->id;
          $data['item_name'] = $item->name;
          $data['image'] = $item->attributes->image;
          $data['price'] = $item->price;
          $data['quantity'] = $item->quantity;
          $data['status'] = 1;

          $order_details = OrderDetail::create($data);       
        }

           Cart::clearCartConditions();
           Cart::clear();
           return redirect('/user_panel'); 

          //dd($result); 
		  }
		  
		} catch (PayPal\Exception\PayPalConnectionException $ex) {
		  echo $ex->getCode();
		  echo $ex->getData();
		  die($ex);
		} catch (Exception $ex) {
		  die($ex);
          }
    }

    public function cancelPaypal(){
          
          return redirect('/paypal_checkout');
    }
}



