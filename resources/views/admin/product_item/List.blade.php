@extends('admin.layouts.master')
@section('title','Dashboard | Product Item')
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
                      Byke Parts List
                    </h3>
                    <div class="card-tools pull-right">
                      <a href="{{route('pro_item.create')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Post</a>
                    </div>
                </div>
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-12">
                            <table id="example1" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th>Sl</th>
                                <th>Item Name</th>
                                <th>Overview</th>
                                <th>Price</th>
                                <th>Rating</th>
                                <th>status</th>
                                <th>action</th>
                              </tr>
                              </thead>
                              <tbody>
                             <?php $i=0; ?>
                              @foreach($products as $product)
                                 <tr>
                                   <td><?php echo ++$i; ?></td>
                                   <td>{{$product->item_name}}</td>
                                   <td>{!! $product->overview !!}</td>
                                   <td>${{$product->price}}</td>
                                   <td>{{$product->rating}}</td>
                                   <td>
                                  @if($product->status==1)
                                    <span class="btn btn-success btn-sm">Active</span>
                                  @else
                                    <span class="btn btn-warning btn-sm">Unactive</span>
                                  @endif   
                                   </td>
                                   <td>
                                  @if($product->status==1)
                                  <a class="btn btn-warning btn-sm" href="" title="Change Status"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
                                 @else
                                  <a class="btn btn-info btn-sm" href=""><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
                                 @endif
                                  <a class="btn btn-success btn-sm" href="{{route('pro_item.edit',$product->id)}}"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                  <form id="delete-form-{{$product->id}}" action="{{route('pro_item.destroy',$product->id)}}" method="POST" style="display:none">
                                      @csrf
                                      @method('DELETE')
                                      
                                    </form>

                                    <button class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Are You Sure You Want to Delete This')){
                                        event.preventDefault();
                                         document.getElementById('delete-form-{{$product->id}}').submit();
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