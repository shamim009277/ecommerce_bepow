@extends('layouts.app')
@section('title','Bipow - One product store')
@section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                    <div class="content-center">
                        <div class="account-form">
                            <div class="title">
                                <h3>Your account</h3>
                            </div>
                            <div class="via-login">
                                <a href="" class="facebook-bg"><i class="fab fa-facebook-f"></i></a>
                                <a href="" class="google-plus-bg"><i class="fab fa-google"></i></a>
                                <a href="" class="linkedin-bg"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-xl-12">
                                        <button type="submit" class="bttn-mid btn-fill w-100">Login Account</button>
                                    </div>
                                    <div class="col-xl-12">
                                        <p>
                                            <a href="{{route('password.request')}}">Forgot password</a> ||
                                            <a href="{{ route('register') }}">Create account</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
@endsection



   