@extends('admin.layouts.master')
@section('title','Dashboard | About')
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
                      About Page
                    </h3>
                </div>
              @if(!empty($single_content))
               {{ Form::open(array('route'=>['about.update',$single_content->id],'method'=>'PUT','files'=>true)) }}
               <?php $btn = "Update Data"; ?>
              @else
               
               {{ Form::open(array('route'=>['about.store'],'method'=>'POST','files'=>true)) }}
               <?php $btn = "Cretae"; ?>
              @endif
              
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                          @include('common.message')

                            <div class="form-group row">
                              <label for="Banner Title" class="col-sm-3 control-label">Banner Title</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Banner Title" value="{{  isset($single_content->title)?$single_content->title:old('title')}}">
                              </div>
                            </div>

                            @if(isset($single_content->image))
                             <div class="form-group row">
                              <label for="Content Image" class="col-sm-3 control-label">Old Banner Image</label>
                              <div class="col-sm-9">
                                <img src="{{ asset('frontend/images/banner/' . $single_content->image) }}" style="width:120px"> 
                              </div>
                            </div>
                             <div class="form-group row">
                              <label for="Content Image" class="col-sm-3 control-label">New Banner Image</label>
                              <div class="col-sm-9">
                                <input type="file" class="" id="image" name="image" onchange="loadFile(event)">
                                <img id="output" width="20%" style="margin-top:5px;" />
                              </div>
                            </div>
                            @else
                             <div class="form-group row">
                              <label for="Content Image" class="col-sm-3 control-label">Banner Image</label>
                              <div class="col-sm-9">
                                <input type="file" class="" id="image" name="image" onchange="loadFile(event)">
                                <img id="output" width="20%" style="margin-top:5px;" />
                              </div>
                            </div>
                            @endif

                            <div class="form-group row">
                              <label for="Description" class="col-sm-3 control-label">Content</label>
                              <div class="col-sm-9">
                                 <textarea class="textarea" class="summernote" name="content" placeholder="Place some text here"
                                >{!!  isset($single_content->content)?$single_content->content:old('content') !!}
                                 </textarea>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="Description" class="col-sm-3 control-label">Vission</label>
                              <div class="col-sm-9">
                                 <textarea class="textarea" class="summernote" name="vission" placeholder="Place some text here"
                                >{!!  isset($single_content->vission)?$single_content->vission:old('vission') !!}
                                 </textarea>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="Description" class="col-sm-3 control-label">Mission</label>
                              <div class="col-sm-9">
                                 <textarea class="textarea" class="summernote" name="mission" placeholder="Place some text here"
                                >{!!  isset($single_content->mission)?$single_content->mission:old('mission') !!}
                                 </textarea>
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