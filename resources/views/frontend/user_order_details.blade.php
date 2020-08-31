@extends('frontend.layouts.frontmaster')
@section('title','Bipow - One Product Store')
@section('content')
    <!--Custom Banner-->
    <section class="section-padding dark-overlay" style="background: url(../../frontend/images/banner-2.jpg) no-repeat center center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered cl-white">
                    <div class="banner-title">
                        <h3>Order Details</h3>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Custom Banner--><!--Custom Banner-->
    
    <!--Checkout area-->
    <section class="section-padding gray-bg-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
                    <div class="checkout-card">
                        <div class="card">
                            <div class="card-header">
                                <h5>User</h5>
                            </div>
                            <div class="card-body">
                               {{Auth::user('web')->first_name .' '. Auth::user('web')->last_name}}<br>
                               {{Auth::user('web')->email}}<br>
                               {{Auth::user('web')->address}}<br>
                               {{Auth::user('web')->number}}
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
                    <div class="checkout-card">
                        <div class="card">
                            <div class="card-header">
                                <h4>Order Ddetails</h4>
                            </div>
                            <div class="card-body">       
                                <div class="table-responsive">          
                                  <table class="table table-hover">
                                      <tr>
                                        <th>Item Name</th>
                                        <td>{{$detail->item_name}}</td>
                                      </tr>
                                      <tr>
                                        <th>Item Image</th>
                                        <td>
                                            <img src="{{asset('frontend/images/product/'.$detail->image)}}" alt="">
                                        </td>
                                      </tr>
                                      <tr>
                                        <th>Payment Method</th>
                                        <td>{{strtoupper($detail->type)}}</td>
                                      </tr>
                                      <tr>
                                        <th>Quantity</th>
                                        <td>{{$detail->quantity}}</td>
                                      </tr>
                                      <tr>
                                        <th>Shipping Cost</th>
                                        <td>${{$detail->shipping_cost}}</td>
                                      </tr>
                                      <tr>
                                        <th>Disciount</th>
                                        @if($detail->total > $detail->subtotal)
                                        <td>${{($detail->total)-($detail->subtotal+$detail->shipping_cost)}}</td>
                                        @else
                                        <td>${{($detail->subtotal)-($detail->total+$detail->shipping_cost)}}</td>
                                        @endif
                                        
                                      </tr>
                                      <tr>
                                        <th>Sub Total</th>
                                        <td>${{$detail->subtotal}}</td>
                                      </tr>
                                      <tr>
                                        <th>Total</th>
                                        <td>${{$detail->total}}</td>
                                      </tr>
                                      
                                  </table>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Checkout area-->

@endsection