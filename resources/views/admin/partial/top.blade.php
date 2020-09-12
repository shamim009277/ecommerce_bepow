<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <?php 
               
         $message = DB::table('contacts')
                   ->where('status',1)
                   ->count();
         $orders = DB::table('oreders')
                   ->where('status',1)
                   ->count();
         $total = $message+$orders;
    ?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown" style="margin-right: 20px;">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">{{$total}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{$total}} Notifications</span>
          <div class="dropdown-divider"></div>

        @if(!empty($message))
          <a href="{{url('admin/manage/contact')}}" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{$message}} new messages
          </a>
        @else
           <a href="{{url('admin/manage/contact')}}" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 0 new messages
          </a>
        @endif

          <div class="dropdown-divider"></div>
        @if(!empty($orders))
          <a href="{{url('admin/manage_orders')}}" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> {{$orders}} new oreders
          </a>
        @else
          <a href="{{url('admin/manage_orders')}}" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 0 new oreders
          </a>
        @endif
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
      <li class="nav-item">
        <a class="btn btn-default btn-flat text-danger" href="{{ route('admin.logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt text-danger"></i> Logout</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
      </li>
      @else
      @endif
    </ul>
  </nav>