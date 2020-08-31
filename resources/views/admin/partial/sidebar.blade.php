<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user('admin')->name}}</a>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php 

               $dashboard = 'admin/dashboard';
           ?>
          <li class="nav-item has-treeview {{ (request()->is($dashboard)) ? 'menu-open' : '' }}">
            <a href="{{URL::to('admin/dashboard')}}" class="nav-link {{ (request()->is($dashboard)) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <?php 

               $item = 'admin/pro_item';
               
           ?>
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Product Items
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL::to('/admin/pro_item')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/admin/pro_image')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Images</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/admin/promo_code')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Promo Code</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Product Features
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL::to('/admin/title')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Feature Title</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/admin/overview')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Feature Overview</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Pages</li>

          <li class="nav-item">
            <a href="{{URL::to('/admin/parts')}}" class="nav-link {{ (request()->is('admin/parts')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>Bike Parts</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{URL::to('/admin/blogs')}}" class="nav-link {{ (request()->is('admin/blogs')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>Blog Content</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{URL::to('/admin/about')}}" class="nav-link {{ (request()->is('admin/about')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>About</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{URL::to('/admin/testimonal')}}" class="nav-link {{ (request()->is('admin/testimonal')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>Testimonial</p>
            </a>
          </li>
 
          <li class="nav-header">Manages</li>
          <li class="nav-item">
            <a href="{{url('/admin/manage_shipping')}}" class="nav-link {{ (request()->is('/admin/manage_shipping')) ? 'active' : '' }}">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Shipping</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/manage_orders')}}" class="nav-link {{ (request()->is('admin/manage_orders')) ? 'active' : '' }}">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Manage Orders</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('admin/manage_payments')}}" class="nav-link {{ (request()->is('admin/manage_payments')) ? 'active' : '' }}">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Manage Payments</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('admin/manage/refund')}}" class="nav-link {{ (request()->is('admin/manage/refund')) ? 'active' : '' }}">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Payment Refund</p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>