@extends('admin.layouts.master')
@section('title','Dashboard | Promo Code')
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
                         Add Promo Code
                    </h3>
                </div>
              @if(!empty($code))
               {{ Form::open(array('route'=>['promo_code.update',$code->id],'method'=>'PUT','files'=>true)) }}
               <?php $btn = "Update Data"; ?>
              @else
               {{ Form::open(array('route'=>['promo_code.store'],'method'=>'POST','files'=>true)) }}
               <?php $btn = "Add Promo Code"; ?>
              @endif
              
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                          @include('common.message')
                            <div class="form-group row">
                              <label for="Content Title" class="col-sm-3 control-label">Product item</label>
                              <div class="col-sm-9">
                                <select class="form-control" name="product_id" id="section">
                                    @if(isset($code))
                                      <option value="{{$code->product_id}}">{{$code->product->item_name}}</option>
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
                            <div class="form-group row">
                              <label for="Content Title" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="eg. Smart Discount 12.5%" value="{{  isset($code->name)?$code->name:old('name')}}">
                                </div>
                            </div>

                            <div class="form-group row">
                              <label for="Content Title" class="col-sm-3 control-label">Code</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="code" name="code" placeholder="eg. GDBXFH" value="{{  isset($code->code)?$code->code:old('code')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                              <label for="Content Title" class="col-sm-3 control-label">Type</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="type" name="type" placeholder="eg. disciount" value="{{  isset($code->type)?$code->type:old('type')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                              <label for="Content Title" class="col-sm-3 control-label">Value</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="value" name="value" placeholder="eg. -13%" value="{{  isset($code->value)?$code->value:old('value')}}" pattern="-[0-9]+%">
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

