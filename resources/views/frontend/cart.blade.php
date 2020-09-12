@extends('frontend.layouts.frontmaster')
@section('title','Bipow - One Product Store')
@push('css')
<style type="text/css" media="screen">
    #total,#subtotal{
        font-size: 18px;
        font-weight: 600;
        font-family: "Didact Gothic";
        text-align: right;
        color:#07485e;
    }
    
</style>
@endpush
@section('content')
<!--Custom Banner-->
    <section class="section-padding dark-overlay" style="background: url(frontend/images/banner-2.jpg) no-repeat center center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered cl-white">
                    <div class="banner-title">
                        <h3>Cart page</h3>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Custom Banner-->
    
    <!--Cart area-->
    <section class="section-padding gray-bg-2">
        <div class="container">
            @include('common.message')
            <div class="row mb-60">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="cart-items table-responsive table-bordered centered">
                        
                    <?php $cart = Cart::isEmpty(); ?>
                    @if($cart==0)
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Item name</th>
                                <th scope="col">Unit Value</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Cancel item</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                 $cartConditions = Cart::getConditions();
                                 $collection = Cart::getContent();
                                 $count = Cart::getContent();
                                 foreach ($cartConditions as $key => $condition) {
                                    
                                 }
                             ?>

                             
                        @foreach($collection as $item)  
                          <form action="{{url('/update_cart')}}" method="POST" accept-charset="utf-8"> 
                          @csrf  
                            <tr>
                                <td><img src="{{asset('frontend/images/product/'.$item->attributes->image)}}" alt=""></td>
                                <td><a href="">{{$item->name}}</a></td>
                                <td>${{$item->price}}</td>
                                <td>
                                    <input min="1" max="100" value="{{$item->quantity}}" 
                                    type="number" name="quantity">
                                </td>
                                <td>${{$item->price * $item->quantity}}</td>
                                <td><a href="{{URL::to('/detele_to_card/'.$item->id)}}"><i class="fas fa-times"></i></a></td>
                            </tr>
                        
                            <tr class="text-right">
                                <td colspan="6">
                                    <button class="bttn-small btn-fill-2 mr-3">Continue Shopping</button>
                                    <button type="submit" class="bttn-small btn-fill">Update</button>
                                </td>
                            </tr>
                       </form>
                    @endforeach
                            </tbody>
                        </table>
                    @else
                       <a href="{{url('/product')}}" class="bttn-small btn-fill-2 mr-3" style="margin: 260px 0px;">Continue Shopping</a>
                       <img src="{{asset('frontend/images/nd.jpg')}}" alt="" style="float: right;">
                    @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
                    <div class="cart-card">
                        
                        <div class="card">
                            <div class="card-header">
                                <h4>Promo Code</h4>
                            </div>
                            <div class="card-body">
                                <p>Input your Promo Code</p>
                                <form action="{{url('/cupon')}}" method="POST" class="form-inline">
                                    @csrf
                                    <input type="text" placeholder="Promo code" name="coupone_code" required>
                                    <button type="submit" class="bttn-small btn-fill-2">Check</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="cart-card">
                        <div class="card">
                            <div class="card-header">
                                <h4>Calculate Total</h4>
                            </div>
                          <form action="{{url('/check')}}" method="POST">
                                 @csrf 
                            <div class="card-body">
                                <div class="single-cart-total">
                                    <p>Subtotal</p>
                                    <input type="text" name="subtotal" id="subtotal" value="${{Cart::getSubTotal()}}">
                                </div>
                                <div class="single-cart-total">
                                    <p>Shipping</p>
                                    <p class="cart-amount"><input class="mr-1" type="radio" id="free_shipping" name="payment" value="Free Shipping" checked required="required"> <label for="free_shipping">Free Shipping</label></p>
                                </div>
                                <div class="single-cart-total">
                                    <p>Shipping</p>
                                    <p class="cart-amount"><input class="mr-1" type="radio" id="premium_shipping" name="payment" value="Premium Shipping" required> <label for="premium_shipping">Premium Shipping: $20.5</label></p>
                                </div>
                                <div class="single-cart-total">
                                    <p>Total</p>
                                    <input type="text" name="total" id="total" value="${{Cart::getTotal()}}">
                                </div>
                                <!-- <a href="{{url('/checkout')}}" class="bttn-small btn-fill">Procceed to Checkout</a>  -->
                              <input type="submit" class="bttn-small btn-fill" value="Procceed to Checkout"> 
                            </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Cart area-->

@endsection
@push('scripts')
<script type="text/javascript">
    
    $(document).ready(function() {

    const premium_shipping = $('#premium_shipping');
    const total = $('#total');
    const subtotal = $('#subtotal');
    $('input:radio[name="payment"]').change(function(e) {
      if($('#premium_shipping').is(':checked')) {
        var val = total.val();
        var length = val.length;
        var data = val.substring(1, length);
        var gettotal = parseInt(data)+20.5;
        total.val('$'+gettotal);
      }else{
        var val = subtotal.val();
        total.val(val);
      }
    });
    });

</script>
@endpush