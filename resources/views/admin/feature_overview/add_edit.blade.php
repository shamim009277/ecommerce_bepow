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
                         Add Product Feature Overview
                    </h3>
                </div>
              @if(!empty($single_overview))
               {{ Form::open(array('route'=>['overview.update',$single_overview->id],'method'=>'PUT','files'=>true)) }}
               <?php $btn = "Update Data"; ?>
              @else
               
               {{ Form::open(array('route'=>['overview.store'],'method'=>'POST','files'=>true)) }}
               <?php $btn = "Add Image"; ?>
              @endif
              
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                          @include('common.message')
                            <div class="form-group row">
                              <label for="Content Title" class="col-sm-3 control-label">Feature Overvie</label>
                              <div class="col-sm-9">
                                <select class="form-control" name="feature_id" id="section">
                                    @if(isset($single_overview))
                                      <option value="{{$single_overview->feature_id}}">{{$single_overview->feature->title}}</option>
                                      <option value="">----------Select----------</option>
                                      @foreach($titles as $title )  
                                      <option value="{{$title->id}}">{{$title->title}}</option>
                                      @endforeach
                                    @else
                                      <option value="">----------Select----------</option>
                                      @foreach($titles as $title )  
                                      <option value="{{$title->id}}">{{$title->title}}</option>
                                      @endforeach
                                    @endif
                                      
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="Description" class="col-sm-3 control-label">Overview</label>
                              <div class="col-sm-9">
                                 <textarea class="textarea" class="summernote" name="overview" placeholder="Place some text here"
                                >{!!  isset($single_overview->overview)?$single_overview->overview:old('overview') !!}
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

