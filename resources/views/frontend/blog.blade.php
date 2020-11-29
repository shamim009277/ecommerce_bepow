@extends('frontend.layouts.frontmaster')
@section('title','Bipow - One Product Store')
@section('content')
 <!--Custom Banner-->
    <section class="section-padding dark-overlay" style="background: url(../frontend/images/banner-2.jpg) no-repeat center center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered cl-white">
                    <div class="banner-title">
                        <h3>Blog page</h3>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Custom Banner-->
    
    <!--Blog-->
    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6">
                    
                @foreach($blogs as $blog) 
                   @if(!empty($blog))
                   <?php 
                         $id = Crypt::encrypt($blog->id);

                    ?>
                    <div class="single-blog-block">
                        <a href="{{url('blogs/details/'.$id)}}">
                            <div class="thumb">
                                <img src="{{ asset('frontend/images/blog/'.$blog->image) }}">
                            </div>
                            <div class="title">
                                <h2>{{$blog->title}}</h2>
                            </div>
                            <div class="meta">
                                <div class="date">
                                    {{ \Carbon\Carbon::parse($blog->created_at)->format('j F, Y ||') }}
                                </div>
                                <div class="author">
                                    Admin
                                </div>
                            </div>
                            <div class="content">
                                <p><?php echo substr($blog->content,0,200); ?>.....</p>
                            </div>
                            <div class="read-more">
                                <button class="bttn-small btn-fill-2">Continue Reading</button>
                            </div>
                        </a>
                    </div>
                    @else
                    @endif      
                @endforeach 
                                
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            {!! $blogs->appends(Request::all())->links() !!}

                            <!-- <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li> -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section><!--/Blog-->

@endsection