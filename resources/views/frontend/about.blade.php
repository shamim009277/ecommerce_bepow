@extends('frontend.layouts.frontmaster')
@section('title','Bipow - One Product Store')
@section('content')
    <!--Custom Banner-->
@if(!empty($about))
    <section class="section-padding dark-overlay" style="background: url({{asset('frontend/images/banner/'.$about->image)}}) no-repeat center center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered cl-white">
                    <div class="banner-title">
                        <h3>{{$about->title}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
    <!--Custom Banner-->
    
    <!--About-->
@if(!empty($about))
    <section class="section-padding gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section-title">
                        <h2>About us</h2>
                    </div>
                    <p>{!! $about->content !!}</p>

                    <h5 class="mb-2">Mission</h5>
                    
                    <p>{!! $about->mission !!}</p>

                    <h5 class="mb-2">Vission</h5>

                    <p>{!! $about->vission !!}</p>
                </div>
            </div>
        </div>
    </section><!--/About-->
@endif

    <section class="section-padding-2 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered">
                    <div class="section-title">
                        <h4>What client says</h4>
                        <h2>Testimonials</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
@if(!empty($testimonials))
        @foreach($testimonials as $testimonial)
                <div class="col-xl-4 col-sm-6">
                    <div class="single-user-review">
                        <div class="quote-icon">
                            <img src="frontend/images/quote.png" alt="">
                        </div>
                        <div class="review">
                            <p>{!!$testimonial->review!!}</p>
                        </div>
                        <div class="reviewer-thumb">
                            <img src="{{ asset('frontend/images/reviewer/' . $testimonial->image) }}" alt="">
                            <p>{{$testimonial->author}}</p>
                        </div>
                    </div>
                </div>
        @endforeach
@else
@endif   
            </div>
        </div>
    </section><!--/User Review Section-->

@endsection