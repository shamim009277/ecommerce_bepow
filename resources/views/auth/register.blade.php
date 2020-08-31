
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        
    <link rel="shortcut icon" href="frontend/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="frontend/images/favicon.ico" type="image/x-icon">

    <title>Bipow - One product store</title>

    <!-- Bootstrap -->
    <link href="frontend/css/bootstrap.min.css" rel="stylesheet">
        
    <link href="frontend/css/fontawesome.min.css" rel="stylesheet">
    <link href="frontend/css/magnific-popup.css" rel="stylesheet">
    <link href="frontend/css/jquery-ui.css" rel="stylesheet">


    <link href="frontend/css/animate.css" rel="stylesheet">
    <link href="frontend/css/owl.carousel.min.css" rel="stylesheet">


    <!-- Main css -->
    <link href="frontend/css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="lds-dual-ring"></div>
    </div><!--/Preloader -->

    <!--Main Content Area-->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
                    <div class="content-center">
                        <div class="account-form">
                            <div class="title">
                                <h3>Create your account</h3>
                            </div>
                            <div class="via-login">
                                <a href="" class="facebook-bg"><i class="fab fa-facebook-f"></i></a>
                                <a href="" class="google-plus-bg"><i class="fab fa-google"></i></a>
                                <a href="" class="linkedin-bg"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="First Name">

                                                @error('first_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="Last Name">

                                                @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus placeholder="Address"></textarea>
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required autocomplete="number" autofocus placeholder="Phone Number">

                                                @error('number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="form-group row">
                                        <div class="col-md-12">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <button type="submit" class="bttn-mid btn-fill w-100">Create my account</button>
                                    </div>
                                    <div class="col-xl-12">
                                        <p><a href="{{route('login')}}">Do you already have an account?</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Main Content Area-->



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="frontend/js/jquery-3.2.1.min.js"></script>
    <script src="frontend/js/jquery-migrate.js"></script>
    <script src="frontend/js/jquery-ui.js"></script>

    <script src="frontend/js/popper.js"></script>
    <script src="frontend/js/bootstrap.min.js"></script>
    <script src="frontend/js/owl.carousel.min.js"></script>

    <script src="frontend/js/magnific-popup.min.js"></script>
    <script src="frontend/js/imagesloaded.pkgd.min.js"></script>
    <script src="frontend/js/isotope.pkgd.min.js"></script>
    
    <script src="frontend/js/waypoints.min.js"></script>
    <script src="frontend/js/jquery.counterup.min.js"></script>
    <script src="frontend/js/wow.min.js"></script>
    <script src="frontend/js/scrollUp.min.js"></script>

    <script src="frontend/js/script.js"></script>

</body>
</html>