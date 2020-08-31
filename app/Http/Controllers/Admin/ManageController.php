<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use App\Oreder;
use App\Refund;
use App\User;
use DB;
use Session;

class ManageController extends Controller
{
    public function manageOrders(){

    	$orders = DB::table('oreders')
    	         ->join('users','oreders.user_id','=','users.id')
    	         ->join('payments','oreders.payment_id','=','payments.id')
    	         ->select('oreders.*','users.first_name','users.last_name','payments.transaction_id','payments.payment_status')
    	         ->orderBy('oreders.id', 'DESC')
    	         ->get();
    	return view ('admin.manage_orders',compact('orders'));
    }

    public function managePayments(){

        $payments = DB::table('payments')
                   ->orderBy('id', 'DESC')
                   ->get();
    	return view ('admin.manage_payment',compact('payments'));
    }

    public function orderDetails($id){
        
        $users = DB::table('oreders')
                ->join('users','oreders.user_id','=','users.id')
                ->select('oreders.*','users.*')
                ->where('oreders.id',$id)
                ->get();
        $shippings = DB::table('oreders')
                   ->join('shippings','oreders.shipping_id','=','shippings.id')
                   ->select('oreders.*','shippings.*')
                   ->where('oreders.id',$id)
                   ->get();
        $details = DB::table('order_details')
                  ->join('oreders','order_details.order_id','=','oreders.id')
                  ->select('order_details.*','oreders.*')
                  ->where('order_details.order_id',$id)
                  ->get();
                   
    	return view ('admin.order_details',compact('users','shippings','details'));
    }

    public function paymentRefund($id){

       $payment = DB::table('payments')
                 ->where('transaction_id',$id)
                 ->first();
       $order = DB::table('oreders')
               ->where('payment_id',$payment->id)
               ->first();
       $id = $id;         

       return view('admin.stripe_refund',compact('payment','order','id'));
    }

    public function manageShipping(){

        $shippings = DB::table('shippings')
                    ->get();
        return view('admin.shipping',compact('shippings'));
    }

    public function paymentRefundCreate(Request $request){

        $refunds = Refund::all();
      foreach($refunds as $refund){
        if ($refund->payment_transaction_id == $request->charge_id) {
           Session::flash('flash_message','This Charged Has Already Refunded.');
           return redirect()->back()->with('status_color','danger');
        } else {
          try {

            $order_id = $request->order_id;

          $stripe = new Stripe('sk_test_ubpjYpwN3JEgSd8xxUqWoOJt00LwOrvWiX', '2019-03-14');
          $refund = $stripe->refunds()->create(
            $request->charge_id,
            $request->refund_amount,
          );
          //dd($refund);

          if ($refund) {
           $data = array();

           $data['order_id'] = $order_id;
           $data['transaction_id'] = $refund['balance_transaction'];
           $data['payment_transaction_id'] = $refund['charge'];
           $data['reason'] = $request->refund_reason;
           $data['amount'] = $refund['amount']/100;
           $data['currency'] =strtoupper($refund['currency']);
           $data['status'] = $refund['object'].' '.$refund['status'];

          } 
          $refund=Refund::create($data);
            return redirect()->back();
          } catch (Exception $e) {
            echo "Something Error Found";
          }
        }
        
        }
 

    }

    public function manageRefund(){
      
       $refunds = Refund::all();
       return view('admin.refund',compact('refunds'));
    }


}
