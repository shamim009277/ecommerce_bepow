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
                      Create Post
                    </h3>
                </div>
              @if(!empty($product))
               {{ Form::open(array('route'=>['pro_item.update',$product->id],'method'=>'PUT','files'=>true)) }}
               <?php $btn = "Update Item"; ?>
              @else
               
               {{ Form::open(array('route'=>['pro_item.store'],'method'=>'POST','files'=>true)) }}
               <?php $btn = "Add Item"; ?>
              @endif
              
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                          @include('common.message')
                            <div class="form-group row">
                              <label for="Content Title" class="col-sm-3 control-label">Product Item</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter Item Name" value="{{  isset($product->item_name)?$product->item_name:old('item_name')}}">
                              </div>
                            </div>
                            
                            <div class="form-group row">
                              <label for="Description" class="col-sm-3 control-label">Product Overview</label>
                              <div class="col-sm-9">
                                 <textarea class="textarea" class="summernote" name="overview" placeholder="Place some text here"
                                >{!!  isset($product->overview)?$product->overview:old('overview') !!}
                                 </textarea>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="Content Title" class="col-sm-3 control-label">Product Price</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="price" name="price" placeholder="Enter Item Price" value="{{  isset($product->price)?$product->price:old('price')}}">
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="Content Title" class="col-sm-3 control-label">Product Rating</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="rating" name="rating" placeholder="Enter Product Rating" value="{{  isset($product->rating)?$product->rating:old('rating')}}">
                              </div>
                            </div>

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
    </section>
@endsection

@push('scripts')
   
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({

            	height: 120,
            	placeholder: 'All Text Will Go There....'

            });
        });
    </script>
  
@endpush