@extends('frontend.layouts.frontmaster')
@section('title','Bipow - One Product Store')

@section('content')
    <!--Banner Area-->
    <section class="banner-area dark-overlay" style="background: url(frontend/images/banner.jpg) no-repeat center fixed;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered">
                    <div class="banner-content">
                        <h2>Bipow your dream bike</h2>
                        <p>Dolor sit amet consectetur adipisicing elit. Reprehenderit, eos sed a vel Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsam amet esse</p>
                        <a href="{{url('/product')}}" class="bttn-mid btn-fill"><i class="fas fa-bicycle"></i>Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Banner Area-->

    <!--Feature Area-->
    <section class="feature-area section-padding-2 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered">
                    <div class="section-title">
                        <h4>Bike parts</h4>
                        <h2>Original Parts</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
            @foreach($parts as $part)    
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="single-feature">
                        <img src="{{asset('frontend/images/parts/'.$part->image)}}" alt="">
                        <h4>{{$part->title}}</h4>
                        <p>{!! $part->short_description !!}</p>
                    </div>
                </div>
            @endforeach       
            </div>
        </div>
    </section><!--/Feature Area-->

    <!--Topic Area-->
    <section class="section-padding primary-bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-sm-6">
                    @foreach($tittles as $title)
                    @endforeach
                    <img src="{{asset('frontend/images/product/'.$title->feature->image)}}" alt="">
                </div>
                <div class="col-xl-6 col-lg-6 col-sm-6">
                    <div class="topic">
                        <div class="section-title">
                             <h2>{{ $title->feature->title }}</h2>
                        </div>
                        <ul>
                        @foreach($tittles as $title)
                            <li>{!! $title->overview !!}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Topic Area-->
    
   
    <!--Product Section-->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-md-7 col-sm-12">
                    <div class="product-details-img mb-30">
                        <div class="row">
                            <div class="col-2">
                              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
     
                            @foreach($product_images as $key=>$image)
                               
                                <a class="nav-link {{ ($key==0) ? 'active':'' }}" id="v-pills-{{substr($image->product_image,0,10)}}-tab" data-toggle="pill" href="#v-pills-{{substr($image->product_image,0,10)}}" role="tab" aria-controls="v-pills-{{substr($image->product_image,0,10)}}" aria-selected="{{($key==0) ? 'true':'false' }}">
                                    <img src="{{asset('frontend/images/product/'.$image->product_image)}}" alt="">
                                </a>
                            @endforeach
                              </div>
                            </div>

                            <div class="col-10">
                              <div class="tab-content" id="v-pills-tabContent">

                            @foreach($product_images as $key=>$image)
            
                                <div class="tab-pane fade {{ ($key==0) ? 'show active':'' }}" id="v-pills-{{substr($image->product_image,0,10)}}" role="tabpanel" aria-labelledby="v-pills-{{substr($image->product_image,0,10)}}-tab">
                                    <img class="magniflier" src="{{asset('frontend/images/product/'.$image->product_image)}}" alt="">
                                </div>
                            @endforeach
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-md-5 col-sm-12">
                    <div class="product-details-content">
                        <h2>{{$image->product->item_name}}</h2>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <a href="">({{$image->product->rating}})</a>
                        </div>
                        <div class="stock">Available item</div>
                        <div class="price price_input">${{$image->product->price}} USD</div>
                        <form action="{{URL::to('/add_to_cart')}}" method="POST">
                            @csrf
                        <div class="quantity">
                            <a href="#" class="quantity__minus"><span>-</span></a>
                            <input name="quantity" type="text" class="quantity__input" value="1">
                            <input name="product_id" type="hidden" class="" value="{{$image->product->id}}">
                            <input name="image" type="hidden" class="" value="{{$image->product_image}}">
                            <a href="#" class="quantity__plus"><span>+</span></a>
                        </div>
                        
                        <div class="overview">
                            <strong>Overview:</strong> 
                            <p>{!! $image->product->overview !!}</p>
                            
                        </div>
                        <div class="btns mb-20">
                            <!-- <a href="cart.html" class="bttn-mid btn-fill-2 mr-2"><i class="fas fa-shopping-cart"></i>Add to Cart</a> -->
                            <button type="submit" class="bttn-mid btn-fill-2 mr-2"><i class="fas fa-shopping-cart"></i>Add to Cart</button>
                            <a href="product-details.html" class="bttn-mid btn-fill">Buy now</a>
                        </div>
                        </form>
                        <div class="product-social-share">
                            <strong>Social Share:</strong>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                            <a href=""><i class="fab fa-pinterest-p"></i></a>
                            <a href=""><i class="far fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Product Section-->

    <!--User Review Section-->
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
            <div class="row">
                <div class="col-xl-4 col-sm-6">
                    <div class="single-user-review">
                        <div class="quote-icon">
                            <img src="frontend/images/quote.png" alt="">
                        </div>
                        <div class="review">
                            <p>Got an amazing bike for my next high ride. Really reasonable price and hight quality performance. Highly Recomended!!</p>
                        </div>
                        <div class="reviewer-thumb">
                            <img src="frontend/images/reviewer/1.jpg" alt="">
                            <p>Astron haat</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <div class="single-user-review">
                        <div class="quote-icon">
                            <img src="frontend/images/quote.png" alt="">
                        </div>
                        <div class="review">
                            <p>Got an amazing bike for my next high ride. Really reasonable price and hight quality performance. Highly Recomended!!</p>
                        </div>
                        <div class="reviewer-thumb">
                            <img src="frontend/images/reviewer/2.jpg" alt="">
                            <p>Astron haat</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <div class="single-user-review">
                        <div class="quote-icon">
                            <img src="frontend/images/quote.png" alt="">
                        </div>
                        <div class="review">
                            <p>Got an amazing bike for my next high ride. Really reasonable price and hight quality performance. Highly Recomended!!</p>
                        </div>
                        <div class="reviewer-thumb">
                            <img src="frontend/images/reviewer/3.jpg" alt="">
                            <p>Astron haat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/User Review Section-->

    <!--newslatter and Instagram feed-->
    <div class="section-padding-2">
        <div class="container">
            <div class="row justify-content-center mb-30">
                <div class="col-xl-12 centered">
                    <div class="section-title">
                        <h4>Follow us <a href="" class="cl-primary">@Bipow</a></h4>
                    </div>
                </div>
                
                @if(!empty($posts))
                @foreach($posts as $post)
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                    <div class="single-insta">
                        <a href="">
                            <img src="{{$post['media_url']}}" alt="">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                @endforeach
                @endif
                      
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-sm-12 centered">
                    <div class="newslatter">
                        <form action="#">
                            <input type="email" placeholder="Email Address" required>
                            <button type="submit">Subscribe</button>
                        </form>
                        <div class="social">
                            <a href=""><i class="fab fa-facebook-square"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                            <a href=""><i class="fab fa-twitter-square"></i></a>
                            <a href=""><i class="fab fa-pinterest-square"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/newslatter and Instagram feed-->

@endsection