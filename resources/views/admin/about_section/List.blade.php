@extends('admin.layouts.master')
@section('title','Dashboard | About')
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
                      About Section
                    </h3>
                    <div class="card-tools pull-right">
                      <a href="{{route('about.create')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Post</a>
                    </div>
                </div>
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-12">
                            <table id="example1" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th>Sl</th>
                                <th>Content</th>
                                <th>Mission</th>
                                <th>Vission</th>
                                <th>action</th>
                              </tr>
                              </thead>
                              <tbody>
                                <?php $n=0; ?>
                              @foreach($abouts as $about)
                                 <tr>
                                    <td><?php echo ++$n; ?></td>
                                    <td>{!! $about->content !!}</td>
                                    <td>{!! $about->mission !!}</td>
                                    <td>{!! $about->vission !!}</td>
                                    <td>
                                       <a class="btn btn-success btn-sm" href="{{route('about.edit',$about->id)}}"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                      <form id="delete-form-{{$about->id}}" action="{{route('about.destroy',$about->id)}}" method="POST"     style="display:none">
                                      @csrf
                                      @method('DELETE')
                                      
                                      </form>

                                     <button class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Are You Sure You Want to Delete This')){
                                        event.preventDefault();
                                         document.getElementById('delete-form-{{$about->id}}').submit();
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