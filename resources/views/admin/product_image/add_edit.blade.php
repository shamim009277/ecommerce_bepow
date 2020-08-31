@extends('admin.layouts.master')
@section('title','Dashboard | Product Item')
@push('css')
       
     <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row mt-20">
          <div class="col-md-12">
             <div class="card card-primary">
                <div class="card-header">
                   <h3 class="card-title">
                      <i class="fas fa-edit"></i>
                         Add Product Item
                    </h3>
                </div>
              @if(!empty($single_products))
               {{ Form::open(array('route'=>['pro_image.update',$single_products->id],'method'=>'PUT','files'=>true)) }}
               <?php $btn = "Update Data"; ?>
              @else
               
               {{ Form::open(array('route'=>['pro_image.store'],'method'=>'POST','files'=>true)) }}
               <?php $btn = "Add Image"; ?>
              @endif
              
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                          @include('common.message')
                            <div class="form-group row">
                              <label for="Content Title" class="col-sm-3 control-label">Product item</label>
                              <div class="col-sm-9">
                                <select class="form-control" name="product_id" id="section">
                                    @if(isset($single_products))
                                      <option value="{{$single_products->product_id}}">{{$single_products->product->item_name}}</option>
                                      <option value="">----------Select----------</option>
                                      @foreach($product_items as $item )  
                                      <option value="{{$item->id}}">{{$item->item_name}}</option>
                                      @endforeach
                                    @else
                                      <option value="">----------Select----------</option>
                                      @foreach($product_items as $item )  
                                      <option value="{{$item->id}}">{{$item->item_name}}</option>
                                      @endforeach
                                    @endif
                                      
                                </select>
                              </div>
                            </div>
                            @if(isset($single_products->product_image))
                            <div class="form-group row">
                              <label for="Content Image" class="col-sm-3 control-label">Old Image</label>
                              <div class="col-sm-9">
                                <img src="{{ asset('frontend/images/product/' . $single_products->product_image) }}" style="width:120px"> 
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Content Image" class="col-sm-3 control-label">New Image</label>
                              <div class="col-sm-9">
                                <input type="file" class="" id="image" name="product_image" onchange="loadFile(event)">
                                <img id="output" width="20%" style="margin-top:5px;" />
                              </div>
                            </div>

                            @else
                            <div class="form-group row">
                              <label for="Content Image" class="col-sm-3 control-label">Image</label>
                              <div class="col-sm-9">
                                <input type="file" class="" id="image" name="product_image" onchange="loadFile(event)">
                                <img id="output" width="20%" style="margin-top:5px;" />
                              </div>
                            </div>
                            @endif
                            <div class="form-group row">
                              <div class="col-md-12">
                                  <button type="submit" class=" btn btn-primary float-right"><?php echo $btn; ?>
                                  </button>
                              </div>
                            </div> 
                        </div>
                    </div>
                
                </div>
                
                </div>
                {!! Form::close() !!}
                
              </div>      
          </div>  
        </div><!-- /.container-fluid -->
        <script>
         var loadFile = function(event) {
         var reader = new FileReader();
         reader.onload = function(){
         var output = document.getElementById('output');
         output.src = reader.result;
                                     };
    reader.readAsDataURL(event.target.files[0]);
       };
      </script>
    </section>
@endsection

