 <header class="header-area light-primary-bg">
        <nav class="navbar navbar-expand-lg main-menu">
            <div class="container-fluid">
                <?php 
                      $logo = DB::table('logos')->first();
                 ?>
            @if(!empty($logo))
                <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('frontend/images/logo/'.$logo->logo)}}" class="d-inline-block align-top" alt=""></a>
            @else 
                <h5>Logo</h5>
            @endif

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="menu-toggle"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{URL::to('/product')}}">Shop</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('about')}}">About us</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{URL::to('/show_cart')}}">Cart page</a></li>
                                <li><a class="dropdown-item" href="{{URL::to('/checkout')}}">Checkout page</a></li>
                                <li><a class="dropdown-item" href="privacy.html">Privacy Policy</a></li>
                                <li><a class="dropdown-item" href="terms.html">Terms and Service</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{route('blog')}}">Blog</a></li>
                        
                        <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="faq.html">Faq</a></li>
                        @if(empty(Auth::user('web')))
                        <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-expanded="false">User Panel</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{url('order/user_order/')}}">Your Order</a></li>
                                <li>
                                    @if(\Illuminate\Support\Facades\Auth::guard('web')->check())
                                    <a class="dropdown-item" href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @else
                                @endif
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                    <?php 
                          $empty = Cart::isEmpty();
                          $total = Cart::getTotalQuantity();

                     ?>
                    <div class="header-btn justify-content-end">
                        <a href="{{url('/product')}}" class="bttn-small btn-fill"><i class="fas fa-bicycle"></i> Order now</a>
                        <a href="{{url('/show_cart')}}" class="bttn-round btn-fill-2 ml-2"><i class="fas fa-shopping-cart"></i>
                         @if($empty)
                            <span>0</span>
                         @else
                            <span>{{$total}}</span>
                         @endif
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>