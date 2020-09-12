@extends('frontend.layouts.frontmaster')
@section('title','Bipow - One Product Store')
@section('content')
    <!--Custom Banner-->
    <section class="section-padding dark-overlay" style="background: url(frontend/images/banner-2.jpg) no-repeat center center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered cl-white">
                    <div class="banner-title">
                        <h3>Contact page</h3>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Custom Banner-->

    <!--Main Content Area-->
    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                    @include('common.message')
                    <div class="content-center">
                        <div class="account-form">
                            <div class="title">
                                <h3>Message us!</h3>
                            </div>
                            <form action="{{route('message.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12">
                                        <input type="text" name="first_name" placeholder="First Name" required>
                                    </div>
                                    <div class="col-xl-12">
                                        <input type="text" name="last_name" placeholder="Last Name" required>
                                    </div>
                                    <div class="col-xl-12">
                                        <input type="email" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="col-xl-12">
                                        <input type="text" name="phone" placeholder="Phone number" required>
                                    </div>
                                    <div class="col-xl-12">
                                        <textarea name="message" rows="4" placeholder="Message" required></textarea>
                                    </div>
                                    <div class="col-xl-12">
                                        <button type="submit" class="bttn-mid btn-fill w-100">Send it</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Main Content Area-->
    
@endsection