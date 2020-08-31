@extends('admin.layouts.master')
@section('title','Dashboard | Order Status Change')
@section('content')
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row mt-20">
          <div class="col-md-12">
             <div class="card card-primary card-outline">
                <div class="card-header">
                   <h3 class="card-title">
                      <i class="fa fa-list" aria-hidden="true"> </i>
                       Order Status Change
                    </h3>
                </div>
                <div class="card-body">
                   <div class="row">
                        <div class="col-md-12">
                          @include('common.message')
                        <form action="{{URL::to('admin/order/status/change')}}" method="post">
                            @csrf
                          
                            <div class="form-group row">
                              <label for="Refund" class="col-sm-3 control-label">Order Status</label>
                              <div class="col-sm-9">
                                <input type="hidden" name="order_id" value={{$id}}>
                                 <select name="status" class="form-control">
                                   <option value="">----------Select Status----------</option>
                                   <option value="1">Pending</option>
                                   <option value="2">Processing</option>
                                   <option value="3">Delivered</option>
                                   <option value="4">Refunded</option>
                                 </select>
                              </div>
                            </div>
                            
                            
                            <div class="form-group row">
                              <div class="col-md-12">
                                  <button type="submit" class=" btn btn-primary float-right">
                                     Change Status
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
