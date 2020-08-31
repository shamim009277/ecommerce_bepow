@extends('frontend.layouts.frontmaster')
@section('title','Bipow - One Product Store')
@section('content')
    <!--Custom Banner-->
    <section class="section-padding dark-overlay" style="background: url(frontend/images/payment.png) no-repeat center center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered cl-white">
                    <div class="banner-title">
                        <h3>Paypal Payment</h3>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Custom Banner-->
    
    <!--Checkout area-->
    <section class="section-padding gray-bg-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="checkout-card">
                        <div class="card">
                        <form action="{{url('/paypal_payment')}}" method="POST" accept-charset="utf-8">
                            @csrf
                            <div class="card-header">
                                <h4>Payment Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="input-text">
                                    <label for="Name">NAME ON CARD</label>
                              
                                    <input type="text" class="input-text" id="name"
                                    name="name" value="" Placeholder="Enter Name">
                                </div>
                                
                                <div class="input-text">
                                    <label for="Name">EMAIL</label>
                              
                                    <input type="email" class="input-text" id="email"
                                    name="email" value="" Placeholder="Enter Email">
                                </div>
                                <button type="submit" class="bttn-small btn-fill">Place order</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <?php
                    $data = Session::get('shipping');
                    $collection = Cart::getContent();
                    $count = Cart::getContent();                
                ?>
                
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="checkout-card">
                        <div class="card">
                            <div class="card-header">
                                <h4>Your order</h4>
                            </div>
                        @foreach($collection as $item)
                            <div class="card-body">
                                <div class="single-checkout-total">
                                    <p class="checkout-amount">Product</p>
                                    <p class="checkout-amount">Subtotal</p>
                                </div>
                                <div class="single-checkout-total">
                                    <p>{{$item->name}}  × {{$item->quantity}}</p>
                                    <p class="checkout-amount">${{$item->price}}</p>
                                </div>
                                <div class="single-checkout-total">
                                    <p class="checkout-amount">Subtotal</p>
                                    <p class="checkout-amount">${{Cart::getSubTotal()}}</p>
                                </div>
                                <div class="single-checkout-total">
                                    <p class="checkout-amount">Total</p>
                                    <h4 class="checkout-amount cl-primary">
                                         ${{Cart::getTotal()}}
                                    </h4>
                                </div>
                        @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Checkout area-->

@endsection