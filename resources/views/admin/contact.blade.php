@extends('admin.layouts.master')
@section('title','Dashboard | Manage Contact')
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
                      Contact List
                    </h3>
                </div>
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-12">
                            <table id="example1" class="table table-bordered table-hover table-responsive">
                              <thead>
                                <tr>
                                  <th>Sl</th>
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Message</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $n=0; ?>
                          @foreach($contacts as $contact)
                                <tr>
                                   <td><?php echo ++$n; ?></td>
                                   <td>{{$contact->first_name}}</td>
                                   <td>{{$contact->last_name}}</td>
                                   <td>{{$contact->email}}</td>
                                   <td>{{$contact->phone}}</td>
                                   <td>{{$contact->message}}</td>
                                   <td>
                                     @if($contact->status == 1)
                                        <a href="{{url('admin/contact/change_unactive/'.$contact->id)}}" class="btn btn-warning btn-sm">New</a>
                                     @else
                                        <a href="#" class="btn btn-danger btn-sm">Read</a>
                                     @endif
                                   </td>
                                   <td>
                                      <form id="delete-form-{{$contact->id}}" action="{{url('admin/contact/destroy',$contact->id)}}" method="POST" style="display:none">
                                          @csrf
                                          @method('GET')
                                          
                                        </form>

                                      <button class="btn btn-danger btn-sm"
                                      onclick="if(confirm('Are You Sure You Want to Delete This')){
                                          event.preventDefault();
                                           document.getElementById('delete-form-{{$contact->id}}').submit();
                                      }else{
                                             event.preventDefault();
                                      }
                                      ">
                                      <i class="fa fa-trash" aria-hidden="true"></i>
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