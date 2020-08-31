@extends('frontend.layouts.frontmaster')
@section('title','Bipow - One Product Store')
@section('content')
    <!--Custom Banner-->
    <section class="section-padding dark-overlay" style="background: url(frontend/images/banner-2.jpg) no-repeat center center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered cl-white">
                    <div class="banner-title">
                        <h3>Checkout page</h3>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Custom Banner-->
    
    <!--Checkout area-->
    <section class="section-padding gray-bg-2">
        <div class="container">
            <div class="row mb-40">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="coupon-accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    Have a coupon?
                                    <a href="" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        Click here to enter your code
                                    </a>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <span>If you have a coupon code, please apply it below.</span>
                                        <form action="{{url('/cupon')}}" method="post">
                                            @csrf
                                            <input type="text" placeholder="Coupon code" name="coupone_code" required>
                                            <!-- <a href="" type="submit" class="bttn-small btn-fill-2">Apply</a> -->
                                            <button type="submit" class="bttn-small btn-fill-2">Apply</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    @include('common.message')
                    <div class="checkout-card">
                        <div class="card">
                            <div class="card-header">
                                <h4>Billing Details</h4>
                            </div>
                            <form action="{{url('/proced_checkout')}}" method="POST" accept-charset="utf-8">
                                @csrf
                            <div class="card-body">
                                <div class="input-text">
                                    <input class="input-text" type="text" name="first_name" placeholder="First name*">
                                </div>
                                <div class="input-text">
                                    <input class="input-text" type="text" name="last_name" placeholder="Last name*">
                                </div>
                                <div class="input-text">
                                    <input class="input-text" type="text" name="company_name" placeholder="Company name">
                                </div>
                                <div class="input-text">
                                    <select name="country">
                                        <option value="United States (US)">United States (US)</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Italy">Italy</option>
                                        <option value="United Kingdom (UK)">United Kingdom (UK)</option>
                                        <option value="France">France</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Ireland">Ireland</option>
                                    </select>
                                </div>
                                <div class="input-text">
                                    <input class="input-text" type="text" name="address1" placeholder="Street address 1*">
                                </div>
                                <div class="input-text">
                                    <input class="input-text" type="text" name="address2" placeholder="Street address 2*">
                                </div>
                                <div class="input-text">
                                    <input class="input-text" type="text" name="city" placeholder="Town / City*">
                                </div>
                                <div class="input-text">
                                    <select name="state">
                                        <option value="Alabama">Alabama</option>
                                        <option value="Alaska">Alaska</option>
                                        <option value="Arizona">Arizona</option>
                                        <option value="California">California</option>
                                        <option value="Florida">Florida</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Hawaii">Hawaii</option>
                                    </select>
                                </div>
                                <div class="input-text">
                                    <input class="input-text" type="text" name="zip" placeholder="Zip*">
                                </div>
                                <div class="input-text">
                                    <input class="input-text" type="text" name="phone" placeholder="Phone">
                                </div>
                                <div class="input-text">
                                    <input class="input-text" type="email" name="email" placeholder="Email*">
                                </div>
                                <div class="input-text">
                                    <textarea name="message" rows="4" placeholder="Additional Message: Note about your order"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $data = Session::get('shipping');
                    $collection = Cart::getContent();
                    $count = Cart::getContent();
                  if ($data=='Premium Shipping') {
                      $condition2 = new \Darryldecode\Cart\CartCondition(array(
                        'name' => 'Shipping Cost',
                        'type' => 'Increment',
                        'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                        'value' => '20.5' 
                    ));
                    Cart::condition($condition2);
                    $cartConditions = Cart::getConditions();
                   }
                   $empty = Cart::isEmpty();
                       
                ?>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="checkout-card">
                        <div class="card">
                        @if($empty)
                            <div class="card-header">    
                                  <h4>You Shopping Cart is Empty</h4>
                                  <!-- <a href="{{url('/product')}}" class="bttn-mid btn-fill">Start Shopping</a> -->    
                            </div>
                        @else    
                            <div class="card-header">
                                <h4>Your order</h4>
                            </div>
                        @endif    
                            <div class="card-body">       
                        @foreach($collection as $item)
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

                               @if($empty)
                                 <center><a href="{{url('/product')}}" class="bttn-mid btn-fill">Start Shopping</a></center>
                               @else
                                  <div class="payment-options">
                                    <ul>
                                        <li>
                                            <input type="radio" id="cash_on" name="payment" value="cash-on-delivery" checked required="required">
                                            <label for="cash_on">Cash on delivery</label>
                                            <div class="payment-option-text">
                                                Make payment when you receive the item
                                            </div>
                                        </li>
                                        <li>
                                            <input type="radio" id="credit_card" name="payment" value="cash-payment" required>
                                            <label for="credit_card">Credit or Debit card</label>
                                            <div class="payment-option-text">
                                                Credit card payment
                                            </div>
                                        </li>
                                        <li>
                                            <input type="radio" id="paypal_payment" name="payment" value="paypal" required>
                                            <label for="paypal_payment">Paypal</label>
                                            <div class="payment-option-text">
                                                Use paypal to instant payment
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- <a href="" class="bttn-small btn-fill">Place order</a> -->
                                <button type="submit" class="bttn-small btn-fill">Place order</button>
                               @endif
                            
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Checkout area-->

@endsection