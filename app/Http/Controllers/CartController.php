<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductItem;
use App\ProductImage;
use App\PromoCode;
use Session;
use Cart;

class CartController extends Controller
{
    public function index(Request $request){
    	
    	$qty = $request->quantity;
    	$id  = $request->product_id;
    	$image = $request->image;

    	$product = ProductItem::where('id',$id)->first();
    	
    	$data['quantity'] =$qty;
        $data['id']       =$product->id;
        $data['name']=$product->item_name;
        $data['price']    =$product->price;
        $data['attributes']['image']=$image;

    	Cart::add($data);

    	return redirect('/show_cart');
    }

    public function show(){

    	return view('frontend.cart');
    }

    public function item_destroy($id){

    	Cart::remove($id);
      return redirect()->back();
    }

    public function check(Request $request){

    	   $shipping = $request->payment;
         Session::put('shipping',$shipping);
         if($shipping == 'Premium Shipping'){
              return redirect('/checkout');   
        }else{   
             return redirect('/checkout');
        }
    }

    
    public function applycupon(Request $request){

       $code = PromoCode::where('status',1)->first();
       $cartConditions = Cart::getConditions();
       $empty = Cart::isEmpty();

       if ($empty) {
          Session::flash('flash_message','Your Cart is Empty');
          return redirect()->back()->with('status_color','danger');
       } else {

        foreach ($cartConditions as $key => $condition) {
            $name = $condition->getName();  

        if (!empty($name)) {
           if ($name == $code->name) {
           Session::flash('flash_message','Already Applied');
           return redirect()->back()->with('status_color','danger');
       } else {
         if ($code->code == $request->coupone_code) {
          $condition1 = new \Darryldecode\Cart\CartCondition(array(
            'name' => $code->name,
            'type' => $code->type,
            'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => $code->value,
        ));
          Cart::condition($condition1);

          Session::flash('flash_message','Promo Code Applied');
          return redirect()->back()->with('status_color','success');
        } else {
          Session::flash('flash_message','Invalid Promo Code');
          return redirect()->back()->with('status_color','danger');
        }
         
       }
         
       } else {
           
           if ($code->code == $request->coupone_code) {
          $condition1 = new \Darryldecode\Cart\CartCondition(array(
            'name' => $code->name,
            'type' => $code->type,
            'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => $code->value,
        ));
          Cart::condition($condition1);

          Session::flash('flash_message','Promo Code Applied');
          return redirect()->back()->with('status_color','success');
        } else {
          Session::flash('flash_message','Invalid Promo Code');
          return redirect()->back()->with('status_color','danger');
        }

        }

       }

         if ($code->code == $request->coupone_code) {
          $condition1 = new \Darryldecode\Cart\CartCondition(array(
            'name' => $code->name,
            'type' => $code->type,
            'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => $code->value,
        ));
          Cart::condition($condition1);

          Session::flash('flash_message','Promo Code Applied');
          return redirect()->back()->with('status_color','success');
        } else {
          Session::flash('flash_message','Invalid Promo Code');
          return redirect()->back()->with('status_color','danger');
        }
       }
       
    }

    public function updateCart(Request $request){

        $qty = $request->quantity;
        $collection = Cart::getContent();
        foreach ($collection as $key => $item) {
        }
        $id=$item->id;
        
         Cart::update($id,[
        'quantity' => [
             'relative' => false,
             'value' => $qty
        ],
        ]);
         Session::flash('flash_message','Card Updated Successfully!');
          return redirect()->back()->with('status_color','success');
    }

    
}
