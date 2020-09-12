@extends('layouts.app')
@section('title','Bipow - One product store')
@section('content')
 <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                    <div class="content-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="account-form">
                            <div class="title">
                                <h3>Recover Account</h3>
                            </div>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Your Email Address">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-xl-12">
                                        <button type="submit" class="bttn-mid btn-fill w-100">Verify Email</button>
                                    </div>
                                    <div class="col-xl-12">
                                        <p><a href="{{route('login')}}">Login account</a> | <a href="{{route('register')}}">Create account</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
