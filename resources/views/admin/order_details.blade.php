@extends('admin.layouts.master')
@section('title','Dashboard | Order Details')
@section('content')
<!-- Main content -->
<section class="content">
<div class="container-fluid">
      <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Customer Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>

                    <tr>
                      <th>Customer Id</th>
                      <th>Customer Name</th>
                      <th>Customer Details</th>
                    </tr>
                  
                  </thead>
                  <tbody>
                @foreach($users as $user)
                    <tr>
                      <td>#{{$user->user_id}}</td>
                      <td>{{$user->first_name}} {{$user->last_name}}</td>
                      <td>
                          <p>Email: {{$user->email}}</p>
                          <p>Phone: {{$user->number}}</p>
                          <p>Address: {{$user->address}}</p>

                      </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


          <div class="col-md-6 col-sm-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Shipping Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Shipping Id</th>
                      <th>Full Name</th>
                      <th>Shipping Details</th>
                    </tr>
                  </thead>
                  <tbody>
              @foreach($shippings as $shipping)  
                    <tr>
                      <td>#{{$shipping->shipping_id}}</td>
                      <td>{{$shipping->first_name}} {{$shipping->last_name}}</td>
                      <td>
                         <p>Email: {{$shipping->email}}</p>
                         <p>Phone: {{$shipping->phone}}</p>
                         <p>Address1: {{$shipping->address1}}</p>
                         <p>Address2: {{$shipping->address2}}</p>
                         <p>{{$shipping->city}}, {{$shipping->state}}, {{$shipping->city}}-{{$shipping->zip}} </p>
                      </td>
                    </tr>
              @endforeach  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Product Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table text-nowrap">
                  <thead>
                    <tr>
                      <th>Order Id</th>
                      <th>Item Name</th>
                      <th>Item image</th>
                      <th>Item Quantity</th>               
                      <th>Item Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    
              @foreach($details as $detail)
                    <tr>
                      <td>#{{$detail->order_id}}</td>
                      <td>{{$detail->item_name}}</td>
                      <td>
                        <img src="{{ asset('frontend/images/product/' . $detail->image) }}" style="width:100px">
                      </td>
                      <td>{{$detail->quantity}}</td>
                      <td>{{$detail->price}}</td>
                    </tr>
              @endforeach
                    <tr>
                      <th>SubTotal</th>
                      <th> ${{$detail->subtotal}}</th>
                    </tr>
                    <tr>
                      <th>Shipping Cost</th>
                      <th>${{$detail->shipping_cost}}</th>
                    </tr>
                    <tr>
                      @if($detail->total > $detail->subtotal)
                        <th> Disciount</th>
                        <th>${{($detail->total)-($detail->subtotal+$detail->shipping_cost)}}</th>
                      @else
                        <th> Disciount</th>
                        <th>${{($detail->subtotal)-($detail->total+$detail->shipping_cost)}}</th>
                      @endif
                    </tr>
                    <tr>
                      <th>Total</th>
                      <th>${{$detail->total}}</th>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

  
  
</section>
    <!-- /.content -->
@endsection

@push('scripts')

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

@endpush