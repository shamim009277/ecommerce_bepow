@extends('admin.layouts.master')
@section('title','Dashboard | Invoice')
@section('content')
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Bepow
                    <small class="float-right"><?php 
                            echo "Date: ". $date = date('F j, Y', time()); ?>  	
                    </small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              
              <!-- info row -->
              <div class="row invoice-info callout callout-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Bepow Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: info@almasaeedstudio.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{$shippings->first_name}} {{$shippings->last_name}}</strong><br>
                    {{$shippings->address1}}<br>
                    {{$shippings->address2}} {{$shippings->city}}-{{$shippings->zip}}<br>
                    Phone: {{$shippings->phone}}<br>
                    Email: {{$shippings->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <br><b>Invoice #00{{$orders->id}}{{$payment->id}}{{$shippings->id}}</b><br>
                  <b>Order ID:</b> #{{$orders->id}}<br>
                  <b>Payment Due:</b> {{$payment->created_at}}<br>
                  <b>Transaction Id:</b> {{$payment->transaction_id}}
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row" style="margin: 50px 0px;">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                  	<h5>Product Details</h5>	

                    <thead>
                    <tr>
                      <th>Sl</th>
                      <th>Product</th>
                      <th>Image</th>
                      <th>Quantity</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    	<?php $n=0; ?>
                @foreach($details as $detail)    	
                    <tr>
                      <td><?php echo ++$n; ?></td>
                      <td>{{$detail->item_name}}</td>
                      <td><img src="{{ asset('frontend/images/product/' . $detail->image) }}" style="width:100px"></td>
                      <td>{{$detail->quantity}}</td>
                      <td>${{$detail->price}}</td>
                    </tr>
                @endforeach    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
            @if($payment->payment_method=='Hand Cash')
                  <img src="{{asset('admin/dist/img/cash.jpg')}}" alt="Visa">
                  <p>Cash on Delivary</p>
            @elseif($payment->payment_method=='paypal')
                 <img src="{{asset('admin/dist/img/1.png')}}" alt="Visa">
                 <p>Paypal</p>
            @else
                 <img src="{{asset('admin/dist/img/visa.jpg')}}" alt="Visa">
                 <p>VISA CARD</p>
            @endif     
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due {{$payment->created_at}}</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal</th>
                        <th>${{$orders->subtotal}}</th>
                      </tr>
                      <tr>
                        <th>Shipping Cost</th>
                        <th>${{$orders->shipping_cost}}</th>
                      </tr>
                      <tr>
                      @if($orders->total > $orders->subtotal)
                        <th> Disciount</th>
                        <th>${{($orders->total)-($orders->subtotal+$orders->shipping_cost)}}</th>
                      @else
                        <th> Disciount</th>
                        <th>${{($orders->subtotal)-($orders->total+$orders->shipping_cost)}}</th>
                      @endif
                      </tr>
                      <tr>
                        <th>Total</th>
                        <th>${{$orders->total}}</th>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection
@push('scripts')
  <script type="text/javascript"> 
     window.addEventListener("load", window.print());
 </script>
@endpush