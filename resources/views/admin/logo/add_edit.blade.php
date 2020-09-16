@extends('admin.layouts.master')
@section('title','Dashboard | Logo')
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
              @if(!empty($single_logo))
               {{ Form::open(array('route'=>['logo.update',$single_logo->id],'method'=>'PUT','files'=>true)) }}
               <?php $btn = "Update Logo"; ?>
              @else
               
               {{ Form::open(array('route'=>['logo.store'],'method'=>'POST','files'=>true)) }}
               <?php $btn = "Add Logo"; ?>
              @endif
              
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                          @include('common.message')
                           <div class="form-group row">
                              <label for="Content Title" class="col-sm-3 control-label">Logo Title</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Logo Title" value="{{  isset($single_logo->title)?$single_logo->title:old('title')}}">
                              </div>
                            </div>
            
                            @if(isset($single_logo->logo))
                             <div class="form-group row">
                              <label for="Logo" class="col-sm-3 control-label">Old Logo</label>
                              <div class="col-sm-9">
                                <img src="{{ asset('frontend/images/logo/' . $single_logo->logo) }}" style="width:120px"> 
                              </div>
                            </div>
                             <div class="form-group row">
                              <label for="Logo" class="col-sm-3 control-label">New Logo</label>
                              <div class="col-sm-9">
                                <input type="file" class="" id="logo" name="logo" onchange="loadFile(event)">
                                <img id="output" width="20%" style="margin-top:5px;" />
                              </div>
                            </div>
                            @else
                             <div class="form-group row">
                              <label for="Content Image" class="col-sm-3 control-label">Logo</label>
                              <div class="col-sm-9">
                                <input type="file" class="" id="logo" name="logo" onchange="loadFile(event)">
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

