@extends('frontend.layouts.frontmaster')
@section('title','Bipow - One Product Store')
@section('content')
 <!--Custom Banner-->
    <section class="section-padding dark-overlay" style="background: url(/../frontend/images/banner-2.jpg) no-repeat center center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered cl-white">
                    <div class="banner-title">
                        <h3>Blog Details</h3>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Custom Banner-->
    
    <!--Blog-->
    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">

               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                    <div class="site-sidebar">
                        <div class="single-sidebar">
                            <h3>Search</h3>
                            <form action="#">
                                <input type="text" placeholder="Search" required>
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="single-sidebar">
                            <h3>Important topic</h3>
                            <ul>
                            @foreach($titles as $title)
                                <li><a href="{{url('blogs/details/'.$title->id)}}">{{$title->title}}</a></li>
                            @endforeach
                            </ul>
                        </div>
                        <div class="single-sidebar">
                            <h3>Social Pages</h3>
                            
                            <div class="social-follow">
                                <a href="" class="facebook-bg"><i class="fab fa-facebook-f"></i></a>
                                <a href="" class="twitter-bg"><i class="fab fa-twitter"></i></a>
                                <a href="" class="instagram-bg"><i class="fab fa-instagram"></i></a>
                                <a href="" class="linkedin-bg"><i class="fab fa-linkedin"></i></a>
                                <a href="" class="pinterest-bg"><i class="fab fa-pinterest"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                

                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                    <div class="single-blog-block">
                        <a href="{{url('blogs/details/'.$blog->id)}}">
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
                                <p>{!! $blog->content !!}</p>
                            </div>
                            
                        </a>
                    </div>
                    <div class="sharethis-inline-share-buttons"></div>
                    <div class="post-share-and-tag row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="social">
                                <span>Share:</span>
                                <a href="" class="cl-facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="" class="cl-twitter"><i class="fab fa-twitter"></i></a>
                                <a href="" class="cl-youtube"><i class="fab fa-youtube"></i></a>
                                <a href="" class="cl-pinterest"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section><!--/Blog-->

@endsection
@push('scripts')

    

@endpush