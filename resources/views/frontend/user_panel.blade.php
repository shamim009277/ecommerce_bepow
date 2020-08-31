@extends('frontend.layouts.frontmaster')
@section('title','Bipow - One Product Store')
@push('css')
<style>
   .order-number{
       border: 2px dotted #A8A8A8;
       text-align: center;
       padding: 5px;
       margin-bottom:20px;
   }
   .order-number p{
      margin: unset;
   }
   .message{
      margin-bottom:50px;
   }
   .message p{
      margin: unset;
   }
</style>
@endpush
@section('content')
    <!--Custom Banner-->
    <section class="section-padding dark-overlay" style="background: url(../frontend/images/banner-2.jpg) no-repeat center center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered cl-white">
                    <div class="banner-title">
                        <h3>User Panel</h3>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Custom Banner-->
    
    <!--Checkout area-->
    <section class="section-padding gray-bg-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="checkout-card">
                        <div class="card">
                            <div class="card-body">
                               <div class="message">
                                  <p>Thank you. Your order has been received.</p>
                                  <p>We will contract you shortly.</p>
                               </div>      
                                <div class="row">
                                    <div class="col-md-3">
                                       <div class="order-number">
                                           <p>Order Number:</p>
                                           <b><p>#{{$order->id}}</p></b>
                                       </div>  
                                    </div>
                                    <div class="col-md-3">
                                       <div class="order-number">
                                           <p>Order Date:</p>
                                          <b><p>{{ \Carbon\Carbon::parse($order->created_at)->format('j F, Y ') }}</p></b>
                                       </div>   
                                    </div>
                                    <div class="col-md-3">
                                        <div class="order-number">
                                           <p>Total:</p>
                                           <b><p>${{$order->total}}</p></b>
                                       </div>  
                                    </div>
                                </div>
                                 
                                <h2 style="padding: 10px 0px;margin-bottom: 10px;">Order Details</h2>
                                <div class="table-responsive">          
                                  <table class="table table-hover table-bordered">
                                      <tr>
                                        <th>Item Name</th>
                                        <td>{{$details->item_name}}({{$details->quantity}})</td>
                                      </tr>
                                      <tr>
                                        <th>Item Image</th>
                                        <td>
                                           <img src="{{asset('frontend/images/product/'.$details->image)}}" alt=""> 
                                        </td>
                                      </tr>
                                      <tr>
                                        <th>Total</th>
                                        <td>${{$order->total}}</td>
                                      </tr>   
                                  </table>
                                </div> 
                                </div>
                        
                           <!-- <div class="card-header">
                                <h4>You didn't order anything</h4>
                           </div> -->
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Checkout area-->

@endsection