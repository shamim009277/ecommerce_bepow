<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\shipping;
use App\OrderDetail;
use App\Oreder;
use App\Payment;
use Cart;
use Session;
use DB;


class CheckController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function checkout(){
        
        return view('frontend.checkout');
    }

    public function userOrder(){
       $id = Auth::user('web')->id;
       $orders = DB::table('oreders')
                 ->join('order_details','oreders.id','=','order_details.order_id')
                 ->select('oreders.*','order_details.item_name')
                 ->where('oreders.user_id',$id)
                 ->orderBy('oreders.id','DESC')
                 ->get();
       return view('frontend.user_order',compact('orders'));
    }

    public function userOrderDetails($id){
       $user_id = Auth::user('web')->id;
       $detail = DB::table('order_details')
                ->join('oreders','order_details.order_id','=','oreders.id')
                ->join('shippings','order_details.shipping_id','=','shippings.id')
                ->select('order_details.*','oreders.subtotal','oreders.shipping_cost','oreders.total','shippings.type')
                ->where('order_details.order_id',$id)
                ->where('order_details.user_id',$user_id)
                ->orderBy('order_details.id','DESC')
                ->first();
       return view('frontend.user_order_details',compact('detail'));

    }

    public function proced_checkout(Request $request){
           
           //return $request->all();
           /* $validator = Validator::make($request->all(),[
            
                'first_name'  =>'required | max:20',    
                'last_name'   =>'required |max:20',
                'address1'    =>'required | max:200',
                'address2'=>'required |max:200',
                'city'=>'required',
                'zip'=>'required |min:3',
                'email'=>'required',
                'phone'=>'required',
                'state'=>'required',
                'payment'=>'required',       
            ]);*/

            /*if($validator->fails())
            {
                $plainErrorText = "";
                $errorMessage = json_decode($validator->messages(), True);
                foreach ($errorMessage as $value) { 
                    $plainErrorText .= $value[0].". ";
                }
                Session::flash('flash_message', $plainErrorText);
                return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
            }*/

            $data = array();

            $data['first_name'] = $request->first_name;
            $data['last_name'] = $request->last_name;
            $data['company_name'] = $request->company_name;
            $data['country'] = $request->country;
            $data['address1'] = $request->address1;
            $data['address2'] = $request->address2;
            $data['city'] = $request->city;
            $data['state'] = $request->state;
            $data['zip'] = $request->zip;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['message'] = $request->message;
            $data['type'] = $request->payment;

            $shipping_id = shipping::create($data);
            Session::put('shipping_id',$shipping_id);
              
           if ($data['type'] == "cash-on-delivery") {
               return redirect('/cash_checkout');
           } else if($data['type'] == "cash-payment"){
                
               return redirect('/stripe_checkout');
           }else{
               return redirect('/paypal_checkout');
              
           }
           
    }

    public function cashPayment(){

      try {

        //Data Store in shipping table
           $data=array();
           $shipping = Session::get('shipping_id');

           $data['user_id'] = Auth::user('web')->id;
           $data['shipping_id'] = $shipping->id;
           $data['pay_id'] = "Hand Cash";
           $data['transaction_id'] = "Hand Cash";
           $data['payment_method'] = "Hand Cash";
           $data['payment_type']   = "Cash-on-delivary";
           $data['card_number']    = "Card";
           $data['currency']       = "USD";
           $data['amount']         = Cart::getTotal();
           $data['payment_status'] = "Hand Cash";
           $data['receipt_email']  = $shipping->email;
           $data['receipt_url']    = 0;
           $data['postal_code']    = $shipping->zip;
           $data['status']         = 1;

           $payment=Payment::create($data);
           Session::put('payment',$payment);

//Data Store in order table
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

//Data Store in Order Details Table
        if ($order) {

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
           Cart::clearCartConditions();
           Cart::clear();
           /*Cart::forget();*/

       return redirect('/user_panel');
        
      } catch (Exception $e) {

        Session::flash('flash_message','Something Error Found.');
        return redirect()->back()->with('status_color','danger');
        
      }

    }

    public function userPanel(){

       $user_id = Auth::user('web')->id;
       $order = Oreder::where('user_id',$user_id)
               ->orderBy('id','DESC')
               ->first();
       $order_id = $order->id;
       $details = OrderDetail::where('user_id',$user_id)
                 ->where('order_id',$order_id)
                 ->orderBy('id','DESC')
                 ->first();
       return view ('frontend.user_panel',compact('order','details'));
    }

    public function serve(){

       echo "404";
    }

}
