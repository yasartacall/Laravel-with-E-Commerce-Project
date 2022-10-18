  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin_home') }}" class="brand-link">
      <img src="{{ asset('assets') }}/admin/dist//img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin YT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets') }}/admin/dist//img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          @auth <!-- authantication varsa bunları göster -->
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            <a href="{{ route('logout') }}" class="d-block">Logout</a>
          @endauth <!-- şuanda login olan kişi admin mi değil mi bakmıyoruz -->
          
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
          <li class="nav-item">
            <a href="{{ route('admin_home') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Home
                
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('admin_category') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              
                Category
               
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('admin_products') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
                Products    
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="{{ route('admin_message') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
                Contact Messages    
            </a>
          </li>
        
          <li class="nav-item">
            <a href="{{ route('admin_review') }}" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Reviews</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin_faq') }}" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>FAQ</p>
            </a>
          </li>

          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="{{route('admin_setting')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Settings</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>