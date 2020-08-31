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
                       Payment Refund
                    </h3>
                </div>
                <div class="card-body">
                   <div class="row">
                        <div class="col-md-12">
                        <form action="{{URL::to('admin/payment/refund/create')}}" method="post">
                            @csrf
                          
                            <div class="form-group row">
                              <label for="Refund" class="col-sm-3 control-label">Refund Amount</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="refund_amount" placeholder="Enter Amount" value="{{$payment->amount}}" readonly>
                              </div>
                            </div>
                            
                            <div class="form-group row">
                              <label for="Refund" class="col-sm-3 control-label">Refund Reason</label>
                              <div class="col-sm-9">
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                <input type="hidden" class="form-control" name="charge_id" value="{{$id}}">
                                <textarea class="form-control" name="refund_reason" placeholder="Enter Refund Reason" value=""></textarea>
                               </div>
                            </div>
                            
                            <div class="form-group row">
                              <div class="col-md-12">
                                  <button type="submit" class=" btn btn-primary float-right">Refund
                                  </button>
                              </div>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
                
              </div>      
          </div>  
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
