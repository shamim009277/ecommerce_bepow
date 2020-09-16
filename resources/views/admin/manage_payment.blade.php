@extends('admin.layouts.master')
@section('title','Dashboard | Manage Payments')
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
                      Payment List
                    </h3>
                </div>
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-12">
                            <table id="example1" class="table table-bordered table-hover table-responsive">
                              <thead>
                              <tr>
                                  <th>Payment Id</th>
                                  <th>Pay Id</th>
                                  <th>Transaction Id</th>
                                  <th>Payment Type</th>
                                  <th>Payment Method</th>
                                  <th>Currency</th>
                                  <th>Total Amount</th>
                                  <th>Payment Status</th>
                                  <th>Recipt</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                        @foreach($payments as $payment)
                                <tr>
                                   <td>{{$payment->id}}</td>
                                   <td>{{$payment->pay_id}}</td>
                                   <td>{{$payment->transaction_id}}</td>
                                   <td>{{$payment->payment_type}}</td>
                                   <td>{{$payment->payment_method}}</td>
                                   <td>{{$payment->currency}}</td>
                                   <td>${{$payment->amount}}</td>
                                   <td>{{$payment->payment_status}}</td>
                                   <td>{{$payment->receipt_email}}</td>
                                   <td>
                              @if($payment->payment_type == 'VISA CARD')
                                   <a href="{{URL::to('admin/payment/refund/'.$payment->pay_id)}}" class="btn btn-info btn-sm">Refund</a>        
                              @endif
                                  <form id="delete-form-{{$payment->id}}" action="{{url('admin/payment/destroy',$payment->id)}}" method="POST" title="Delete" style="display:none">
                                      @csrf
                                      @method('GET')
                                      
                                    </form>

                                  <button class="btn btn-danger btn-sm"
                                  onclick="if(confirm('Are You Sure You Want to Delete This')){
                                      event.preventDefault();
                                       document.getElementById('delete-form-{{$payment->id}}').submit();
                                  }else{
                                         event.preventDefault();
                                  }
                                  ">
                                    Delete
                                  </button>
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