@extends('admin.layouts.master')
@section('title','Dashboard | Manage Refund')
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
                      Refund List
                    </h3>
                </div>
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-12">
                            <table id="example1" class="table table-bordered table-hover table-responsive">
                              <thead>
                                <tr>
                                  <th>Order Id</th>
                                  <th>Transaction Id</th>
                                  <th>payment Transaction Id</th>
                                  <th>Reason</th>
                                  <th>Amount</th>
                                  <th>Currency</th>
                                  <th>Status</th>
                                  
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                          @foreach($refunds as $refund)
                                <tr>
                                   <td>#{{$refund->order_id}}</td>
                                   <td>{{$refund->transaction_id}}</td>
                                   <td>{{$refund->payment_transaction_id}}</td>
                                   <td>{{$refund->reason}}</td>
                                   <td>${{$refund->amount}}</td>
                                   <td>{{$refund->currency}}</td>
                                   <td>{{$refund->status}}</td>
                                   
                                   <td>
                                     <a href="" class="btn btn-danger btn-sm">Delete</a>
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