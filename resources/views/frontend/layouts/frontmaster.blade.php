<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        
    <link rel="shortcut icon" href="{{asset('frontend/images/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('frontend/images/favicon.ico')}}" type="image/x-icon">

    <title>@yield('title')</title>
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5f5e83e2a86c6e0012410ffb&product=inline-share-buttons" async="async"></script>
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Bootstrap -->
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
        
    <link href="{{asset('frontend/css/fontawesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/jquery-ui.css')}}" rel="stylesheet">


    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/owl.carousel.min.css')}}" rel="stylesheet">


    <!-- Main css -->
    <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 @stack('css')
</head>
<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="lds-dual-ring"></div>
    </div><!--/Preloader -->

    <!--Header Area-->
    @include('frontend.partial.header')
    <!--/Header Area-->
    @yield('content')
    <!--Footer Area-->
    @include('frontend.partial.footer')
    <!--/Footer Area-->



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('frontend/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery-migrate.js')}}"></script>
    <script src="{{asset('frontend/js/jquery-ui.js')}}"></script>

    <script src="{{asset('frontend/js/popper.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>

    <script src="{{asset('frontend/js/magnific-popup.min.js')}}"></script>
    <script src="{{asset('frontend/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/js/isotope.pkgd.min.js')}}"></script>
    
    <script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('frontend/js/wow.min.js')}}"></script>
    <script src="{{asset('frontend/js/scrollUp.min.js')}}"></script>

    <script src="{{asset('frontend/js/script.js')}}"></script>
    <script>
        var x = document.getElementById("demo");
        
        function getLocation() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
          } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
          }
        }
        
        function showPosition(position) {
          x.innerHTML = "Latitude: " + position.coords.latitude + 
          "<br>Longitude: " + position.coords.longitude;
        }
    </script>
    @stack('scripts')

</body>
</html>