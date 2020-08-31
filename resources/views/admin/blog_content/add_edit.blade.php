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
                         Add Blog Content
                    </h3>
                </div>
              @if(!empty($blog))
               {{ Form::open(array('route'=>['blogs.update',$blog->id],'method'=>'PUT','files'=>true)) }}
               <?php $btn = "Update Post"; ?>
              @else
               
               {{ Form::open(array('route'=>['blogs.store'],'method'=>'POST','files'=>true)) }}
               <?php $btn = "Add Post"; ?>
              @endif
              
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                          @include('common.message')
                            <div class="form-group row">
                              <label for="Content Title" class="col-sm-3 control-label">Content Title</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Content Title" value="{{  isset($blog->title)?$blog->title:old('title')}}">
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="Description" class="col-sm-3 control-label">Blog Content</label>
                              <div class="col-sm-9">
                                 <textarea class="textarea" class="summernote" name="content" placeholder="Place some text here"
                                >{!!  isset($blog->content)?$blog->content:old('content') !!}
                                 </textarea>
                              </div>
                            </div>

                            @if(isset($blog->image))
                            <div class="form-group row">
                              <label for="Content Image" class="col-sm-3 control-label">Old Image</label>
                              <div class="col-sm-9">
                                <img src="{{ asset('frontend/images/blog/' . $blog->image) }}" style="width:120px"> 
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Content Image" class="col-sm-3 control-label">New Image</label>
                              <div class="col-sm-9">
                                <input type="file" class="" id="image" name="image" onchange="loadFile(event)">
                                <img id="output" width="20%" style="margin-top:5px;" />
                              </div>
                            </div>

                            @else
                            <div class="form-group row">
                              <label for="Content Image" class="col-sm-3 control-label">Image</label>
                              <div class="col-sm-9">
                                <input type="file" class="" id="image" name="image" onchange="loadFile(event)">
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

