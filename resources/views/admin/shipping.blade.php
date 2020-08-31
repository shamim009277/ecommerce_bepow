@extends('admin.layouts.master')
@section('title','Dashboard | Manage Shipping')
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
                      Shipping List
                    </h3>
                </div>
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-12">
                            <table id="example1" class="table table-bordered table-hover table-responsive">
                              <thead>
                              <tr>
                                  <th>Payment Id</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Company</th>
                                  <th>Country</th>
                                  <th>Address1</th>
                                  <th>Address2</th>
                                  <th>City & zip</th>
                                  <th>phone</th>
                                  <th>Message</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                                <?php $n=0; ?>
                        @foreach($shippings as $shipping)
                                <tr>
                                   <td>{{$shipping->id}}</td>
                                   <td>{{$shipping->first_name}} {{$shipping->last_name}}</td>
                                   <td>{{$shipping->email}}</td>
                                   <td>{{$shipping->company_name}}</td>
                                   <td>{{$shipping->country}}</td>
                                   <td>{{$shipping->address1}}</td>
                                   <td>{{$shipping->address2}}</td>
                                   <td>{{$shipping->city}} {{$shipping->zip}}</td>
                                   <td>{{$shipping->phone}}</td>
                                   <td>{{$shipping->message}}</td>
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