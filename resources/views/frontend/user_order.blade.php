@extends('frontend.layouts.frontmaster')
@section('title','Bipow - One Product Store')
@section('content')
    <!--Custom Banner-->
    <section class="section-padding dark-overlay" style="background: url(../frontend/images/banner-2.jpg) no-repeat center center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered cl-white">
                    <div class="banner-title">
                        <h3>User Order</h3>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Custom Banner-->
    
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
                        @if(!empty($orders))
                            <div class="card-header">
                                <h4>Order List</h4>
                            </div>
                            <div class="card-body">       
                         
                                <div class="table-responsive">          
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Order Number</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Total Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                      <tr>
                                        <td>#{{$order->id}}</td>
                                        <td>{{$order->item_name}}</td>
                                        <td>{{$order->quantity}}</td>
                                        <td>${{$order->total}}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($order->created_at)->format('j F, Y ') }}
                                        </td>
                                        <td>
                                            @if($order->status==1)
                                               <span class="btn btn-warning btn-sm">Pending</span>
                                            @elseif($order->status==2)
                                               <span class="btn btn-info btn-sm">Processing</span>
                                            @elseif($order->status==3)
                                               <span class="btn btn-success btn-sm">Delivered</span>
                                            @else 
                                               <span class="btn btn-success btn-sm">Refunded</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/order/user_order_details/'.$order->id)}}" class="btn btn-info btn-md" >Details</a>
                                        </td>
                                      </tr>
                                    @endforeach
                                    </tbody>
                                  </table>
                                  </div> 
                            </div>
                        @else
                           <div class="card-header">
                                <h4>You didn't order anything</h4>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Checkout area-->

@endsection