@extends('admin.layouts.master')
@section('title','Dashboard | Manage Orders')
@section('content')
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row mt-20">
          <div class="col-md-12">
            @include('common.message')
             <div class="card card-primary card-outline">
                <div class="card-header">
                   <h3 class="card-title">
                      <i class="fa fa-list" aria-hidden="true"> </i>
                      Order List
                    </h3>
                </div>
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-12">
                            <table id="example1" class="table table-bordered table-hover table-responsive">
                              <thead>
                              <tr>
                                <th>Order Id</th>
                								<th>Customer Name</th>
                								<th>Order Total</th>
                								<th>Order Status</th>
                                <th>Order Date</th>
                								<th>Payment Id</th>
                								<th>Transaction Id</th>
                                <th>Create Invoice</th>
                								<th>Payment Status</th>
                								<th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                            @foreach($orders as $order)
                             <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->first_name}} {{$order->last_name}}</td>
                                <td>${{$order->total}}</td>
                                <td>
                                    @if($order->status==1)
                                       <a class="btn btn-warning btn-sm">Pending</a>
                                    @elseif($order->status==2)
                                       <span class="btn btn-info btn-sm">Processing</span>
                                    @elseif($order->status==3)
                                       <span class="btn btn-danger btn-sm">Delivered</span>
                                    @else 
                                       <span class="btn btn-primary btn-sm">Refunded</span>
                                    @endif
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('j F, Y || h:m:s A') }}
                                </td>
                                <td>{{$order->payment_id}}</td>
                                <td>{{$order->transaction_id}}</td>
                                <td>
                                  <a href="{{url('admin/create/invoice/'.$order->id)}}" class="btn btn-primary btn-sm" target="_blank">Invoice</a>
                                </td>
                                <td>{{$order->payment_status}}</td>
                                <td>
                                  <a href="{{url('admin/order/status_change/'.$order->id)}}" class="btn btn-warning btn-sm" title="Change Status"><i class="fa fa-eye" aria-hidden="true"></i></a>
                  
                                 <a href="{{URL::to('admin/order_details/'.$order->id)}}" class="btn btn-info btn-sm" title="Show Details"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                 <form id="" action="" method="POST" style="display:none">
                                    @csrf
                                    @method('DELETE') 
                                    </form>

                                        <button class="btn btn-danger btn-sm" title="Delete" onclick="if(confirm('Are you sure you want to delete this slider permanently !!')){
                                          event.preventDefault();
                                          document.getElementById('delete-form-{{$order->id}}').submit();
                                        }else{
                                          event.preventDefault();
                                        }"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </td>
                             </tr>
                            @endforeach
                              </tbody>
                            </table>
                       </div> 
                   </div>
                </div>
                
              </div>      
          </div>  
        </div><!-- /.container-fluid -->
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