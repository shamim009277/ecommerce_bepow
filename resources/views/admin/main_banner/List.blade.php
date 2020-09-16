@extends('admin.layouts.master')
@section('title','Dashboard | Main Banner')
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
                      Main Banner
                    </h3>
                    <div class="card-tools pull-right">
                      <a href="{{route('main_banners.create')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Post</a>
                    </div>
                </div>
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-12">
                            <table id="example1" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th>Sl</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Banner Content</th>
                                <th>action</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $i=0; ?>
                              @foreach($main_banners as $banner)
                                 <tr>
                                   <td><?php echo ++$i; ?></td>
                                   <td>{{$banner->title}}</td>
                                   <td>
                                     <img src="{{ asset('frontend/images/banner/' . $banner->image) }}" style="width:70px">
                                   </td>
                                   <td>{!! $banner->content !!}</td>
                                   
                                   <td>
                                  <a class="btn btn-success btn-sm" href="{{route('main_banners.edit',$banner->id)}}"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                  <form id="delete-form-{{$banner->id}}" action="{{route('main_banners.destroy',$banner->id)}}" method="POST" style="display:none">
                                      @csrf
                                      @method('DELETE')
                                      
                                    </form>

                                    <button class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Are You Sure You Want to Delete This')){
                                        event.preventDefault();
                                         document.getElementById('delete-form-{{$banner->id}}').submit();
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